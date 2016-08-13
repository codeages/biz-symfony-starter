<?php
namespace AppBundle\Twig;

class HelperExtension extends \Twig_Extension
{
    protected $scripts = array();

    protected $csses = array();

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('script', array($this, 'script')),
            new \Twig_SimpleFunction('css', array($this, 'css')),
            new \Twig_SimpleFunction('form_csrf_token', array($this, 'rendorFormCsrfToken'), array('is_safe' => array('html'))),
        );
    }

    public function script($paths = null)
    {
        if (empty($paths)) {
            return array_unique($this->scripts);
        }

        if (!is_array($paths)) {
            $paths = array($paths);
        }

        $this->scripts = array_merge($this->scripts, $paths);
    }

    public function css($paths = null)
    {
        if (empty($paths)) {
            return array_unique($this->csses);
        }

        if (!is_array($paths)) {
            $paths = array($paths);
        }

        $this->csses = array_merge($this->csses, $paths);
    }

    public function rendorFormCsrfToken($id = null)
    {
        if (empty($id)) {
            $id = $this->container->getParameter('app.csrf.token_id.default');
        }

        $token = $this->container->get('security.csrf.token_manager')->getToken($id)->getValue();

        return sprintf('<input type="hidden" name="%s" value="%s">', $this->container->getParameter('app.csrf.token_form_name') ,$token);
    }

    public function getName()
    {
        return 'app_helper';
    }
}