<?php

namespace AppBundle\Twig;

use Codeages\Biz\Framework\DataStructure\UniquePriorityQueue;

class HelperExtension extends \Twig_Extension
{
    protected $scripts = array();

    protected $csses = array();

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->scripts = new UniquePriorityQueue();
        $this->csses = new UniquePriorityQueue();
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('script', array($this, 'script')),
            new \Twig_SimpleFunction('css', array($this, 'css')),
            new \Twig_SimpleFunction('select_options', array($this, 'selectOptions'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('radios', array($this, 'radios'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('checkboxs', array($this, 'checkboxs'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('parameter', array($this, 'getParameter')),
            new \Twig_SimpleFunction('form_csrf_token', array($this, 'rendorFormCsrfToken'), array('is_safe' => array('html'))),
            
        );
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('money', [$this, 'formatMoney']),
        ];
    }

    public function script($paths = null, $priority = 0)
    {
        if (empty($paths)) {
            return $this->scripts;
        }

        if (!is_array($paths)) {
            $paths = array($paths);
        }

        foreach ($paths as $path) {
            $this->scripts->insert($path, $priority);
        }
    }

    public function css($paths = null, $priority = 0)
    {
        if (empty($paths)) {
            return $this->csses;
        }

        if (!is_array($paths)) {
            $paths = array($paths);
        }

        foreach ($paths as $path) {
            $this->csses->insert($path, $priority);
        }
    }

    public function selectOptions($choices, $selected = null, $empty = null)
    {
        $html = '';

        if (!is_null($empty)) {
            if (is_array($empty)) {
                foreach ($empty as $key => $value) {
                    $html .= "<option value=\"{$key}\">{$value}</option>";
                }
            } else {
                $html .= "<option value=\"0\">{$empty}</option>";
            }
        }

        foreach ($choices as $value => $name) {
            if ($selected == $value) {
                $html .= "<option value=\"{$value}\" selected=\"selected\">{$name}</option>";
            } else {
                $html .= "<option value=\"{$value}\">{$name}</option>";
            }
        }

        return $html;
    }

    public function radios($name, $choices, $checked = null)
    {
        $html = '';

        foreach ($choices as $value => $label) {
            if ($checked == $value) {
                $html .= "<label><input type=\"radio\" name=\"{$name}\" value=\"{$value}\" checked=\"checked\"> {$label}</label>";
            } else {
                $html .= "<label><input type=\"radio\" name=\"{$name}\" value=\"{$value}\"> {$label}</label>";
            }
        }

        return $html;
    }

    public function checkboxs($name, $choices, $checkeds = array())
    {
        $html = '';

        if (!is_array($checkeds)) {
            $checkeds = array($checkeds);
        }

        foreach ($choices as $value => $label) {
            if (in_array($value, $checkeds)) {
                $html .= "<label><input type=\"checkbox\" name=\"{$name}[]\" value=\"{$value}\" checked=\"checked\"> {$label}</label>";
            } else {
                $html .= "<label><input type=\"checkbox\" name=\"{$name}[]\" value=\"{$value}\"> {$label}</label>";
            }
        }

        return $html;
    }

    public function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    public function rendorFormCsrfToken($id = null)
    {
        if (empty($id)) {
            $id = $this->container->getParameter('app.csrf.token_id.default');
        }

        $token = $this->container->get('security.csrf.token_manager')->getToken($id)->getValue();

        return sprintf('<input type="hidden" name="%s" value="%s">', $this->container->getParameter('app.csrf.token_form_name'), $token);
    }

    public function formatMoney($value)
    {
        $value = (string) $value;
        $value = str_pad($value, 3, '0', STR_PAD_LEFT);

        $integer = substr($value, 0, -2);
        $decimals = substr($value, -2);

        return "{$integer}.{$decimals}";
    }

    public function getName()
    {
        return 'app_helper';
    }
}
