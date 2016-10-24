<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        // $user = $this->getUserService()->getUser(1);
        // var_dump($user);
        return $this->render('AppBundle:Default:index.html.twig', array());
    }

    protected function getUserService()
    {
        return $this->biz->service('User:UserService');
    }
}
