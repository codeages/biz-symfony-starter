<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('AdminBundle:Default:dashboard.html.twig', array(
        ));
    }

    protected function getExampleService()
    {
        return $this->biz['example_service'];
    }
}
