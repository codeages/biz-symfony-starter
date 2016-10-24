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

    /**
     * 注意：此方法为示例方法，不能作为正式的用户注册的业务方法，请修改。
     */
    public function createUser($fields)
    {
        $user = [];
        $user['username'] = $fields['username'];

        $user['salt'] = md5(time().mt_rand(0, 1000));
        $user['password'] = $this->biz['user.password_encoder']->encodePassword($fields['password'], $user['salt']);
        $user['roles'] = empty($fields['roles']) ? array('ROLE_USER') : $fields['roles'];

        return $this->getUserDao()->create($user);
    }

    protected function getUserDao()
    {
        return $this->biz->dao('User:UserDao');
    }
}
