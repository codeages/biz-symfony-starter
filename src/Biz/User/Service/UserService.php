<?php

namespace Biz\User\Service;

interface UserService
{
    public function getUser($id);

    public function getUserByUsername($username);

    public function createUser($user);
}
