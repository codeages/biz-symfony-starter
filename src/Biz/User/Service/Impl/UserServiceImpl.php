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

    public function createUser($user)
    {
        return $this->getUserDao()->create($user);
    }

    protected function getUserDao()
    {
        return $this->biz->dao('User:UserDao');
    }
}
