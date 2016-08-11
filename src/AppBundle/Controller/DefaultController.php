<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Example:index.html.twig', array(
            // 'example' => $this->getExampleService()->getExample(1)
        ));
    }

    protected function getUserService()
    {
        return $this->biz['user_service'];
    }
}
