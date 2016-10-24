<?php

use Codeages\Biz\Framework\UnitTests\BaseTestCase;

class UserServiceTest extends BaseTestCase
{
    public function testCreateUser()
    {
        $user = array(
            'username' => 'test_user',
        );
        $created = $this->getUserService()->createUser($user);

        $this->assertEquals($user['username'], $created['username']);
    }

    public function testGetUser()
    {
        $user = array(
            'username' => 'test_user',
        );
        $user = $this->getUserService()->createUser($user);

        $found = $this->getUserService()->getUser($user['id']);

        $this->assertEquals($user['id'], $found['id']);
    }

    public function testGetUserByUsername()
    {
        $user = array(
            'username' => 'test_user',
        );
        $user = $this->getUserService()->createUser($user);

        $found = $this->getUserService()->getUserByUsername($user['username']);

        $this->assertEquals($user['username'], $found['username']);
    }

    protected function getUserService()
    {
        return self::$kernel['user_service'];
    }
}
