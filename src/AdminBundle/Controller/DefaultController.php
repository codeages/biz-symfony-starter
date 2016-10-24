<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('AdminBundle:Default:index.html.twig', array());
    }
    
}
