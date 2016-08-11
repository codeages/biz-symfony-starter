<?php
namespace Biz\User;

interface UserService
{
    public function getUser($id);

    public function getUserByUsername($username);

    public function register($user);
}