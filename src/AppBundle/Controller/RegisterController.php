<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RegisterController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ('POST' == $request->getMethod()) {
            $user = $request->request->all();
            $user = $this->getUserService()->register($user);
            $this->login($user, $request);
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('AppBundle:Register:index.html.twig');
    }

    protected function getUserService()
    {
        return $this->biz['user_service'];
    }
}