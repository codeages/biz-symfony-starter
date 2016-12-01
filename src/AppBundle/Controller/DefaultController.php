<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array());
    }

    protected function getUserService()
    {
        return $this->biz->service('User:UserService');
    }
}
