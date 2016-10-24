<?php

namespace Biz\User\Service\Impl;

use Codeages\Biz\Framework\Service\BaseService;
use Biz\User\Service\UserService;

class UserServiceImpl extends BaseService implements UserService
{
    public function getUser($id)
    {
        return $this->getUserDao()->get($id);
    }

    public function getUserByUsername($username)
    {
        return $this->getUserDao()->getByUsername($username);
    }

    public function createUser($fields)
    {
        $user = [];
        $user['username'] = $fields['username'];

        $user['salt'] = md5(time().mt_rand(0, 1000));
        $user['password'] = $this->biz['user.password_encoder']->encodePassword($fields['password'], $user['salt']);

        if (empty($user['roles'])) {
            $user['roles'] = array('ROLE_USER');
        }

        return $this->getUserDao()->create($user);
    }

    protected function getUserDao()
    {
        return $this->biz->dao('User:UserDao');
    }
}
