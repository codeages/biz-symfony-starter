<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseController extends Controller
{
    protected $biz;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->biz = $this->container->get('biz');
    }
}
