<?php
namespace AppBundle\Twig;

class AssetHelperExtension extends \Twig_Extension
{
    protected $scripts = array();

    protected $csses = array();

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('script', array($this, 'script')),
            new \Twig_SimpleFunction('css', array($this, 'css')),
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

    public function getName()
    {
        return 'app_asset_helper';
    }
}