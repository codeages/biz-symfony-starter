<?php

namespace APIBundle\Controller;

use Codeages\Biz\Framework\Service\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends BaseController
{
    /**
     * @Route("/users/{id}")
     */
    public function getAction($id)
    {
        $user = $this->getUserService()->getUser($id);
        if (!$user) {
            throw new NotFoundHttpException("用户不存在");
        }

        return $user;
    }

    /**
     * @return \Biz\User\Service\UserService
     */
    protected function getUserService()
    {
        return $this->biz->service('User:UserService');
    }
}
