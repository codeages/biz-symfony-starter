<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Example:index.html.twig', array(
            'example' => $this->getExampleService()->getExample(1)
        ));
    }

    protected function getExampleService()
    {
        return $this->biz['example_service'];
    }
}
