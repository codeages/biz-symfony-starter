<?php

use Codeages\Biz\Framework\UnitTests\BaseTestCase;

class ExampleServiceTest extends BaseTestCase
{
    public function testRegister()
    {
        $user = array (
            'username' => 'test_user',
            'password' => 'imtest',
        );
        $registed = $this->getUserService()->register($user);

        $this->assertEquals($user['username'], $registed['username']);
    }

    public function testGetUser()
    {
        $user = array (
            'username' => 'test_user',
            'password' => 'imtest',
        );
        $user = $this->getUserService()->register($user);

        $found = $this->getUserService()->getUser($user['id']);

        $this->assertEquals($user['id'], $found['id']);
    }

    public function testGetUserByUsername()
    {
        $user = array (
            'username' => 'test_user',
            'password' => 'imtest',
        );
        $user = $this->getUserService()->register($user);

        $found = $this->getUserService()->getUserByUsername($user['username']);

        $this->assertEquals($user['username'], $found['username']);
    }

    protected function getUserService()
    {
        return self::$kernel['user_service'];
    }

}