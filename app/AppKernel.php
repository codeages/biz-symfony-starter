<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Codeages\PluginBundle\System\PluginConfigurationManager;
use Codeages\PluginBundle\System\PluginableHttpKernelInterface;

class AppKernel extends Kernel implements PluginableHttpKernelInterface
{
    protected $pluginConfigurationManager;

    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);
        date_default_timezone_set('Asia/Shanghai');
        $this->pluginConfigurationManager = new PluginConfigurationManager($this->getRootDir());
    }

    public function boot()
    {
        if (true === $this->booted) {
            return;
        }

        if ($this->loadClassCache) {
            $this->doLoadClassCache($this->loadClassCache[0], $this->loadClassCache[1]);
        }

        $this->initializeBundles();
        $this->initializeContainer();
        $this->initializeBiz();

        foreach ($this->getBundles() as $bundle) {
            $bundle->setContainer($this->container);
            $bundle->boot();
        }

        $this->booted = true;

        parent::boot();
    }

    protected function initializeBiz()
    {
        $biz = $this->getContainer()->get('biz');
        $biz['migration.directories'][] = dirname(__DIR__) . '/migrations';
        $biz['user.password_encoder'] = function() {
            return new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha256');
        }; 

        $biz->register(new \Codeages\Biz\Framework\Provider\DoctrineServiceProvider());
        $biz->boot();
    }

    public function registerBundles()
    {
        $bundles = array(
            new Codeages\PluginBundle\FrameworkBundle(),
            // new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new AdminBundle\AdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function getCacheDir()
    {
        return dirname($this->rootDir).'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return dirname($this->rootDir).'/var/logs';
    }

    public function getPluginConfigurationManager()
    {
        return $this->pluginConfigurationManager;
    }
}
