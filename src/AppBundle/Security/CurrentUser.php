<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Codeages\Biz\Framework\Context\CurrentUserInterface;

class CurrentUser implements CurrentUserInterface, AdvancedUserInterface, EquatableInterface, \ArrayAccess
{
    protected $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function getRoles()
    {
        return $this->fields['roles'];
    }

    public function getPassword()
    {
        return $this->fields['password'];
    }

    public function getSalt()
    {
        return $this->fields['salt'];
    }

    public function getUsername()
    {
        return $this->fields['username'];
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    public function isEqualTo(UserInterface $user)
    {
        if ($this->username !== $user->getUsername()) {
            return false;
        }

        if (array_diff($this->roles, $user->getRoles())) {
            return false;
        }

        if (array_diff($user->getRoles(), $this->roles)) {
            return false;
        }

        return true;
    }

    public function isLogin()
    {
        return empty($this->id) ? false : true;
    }

    public function isAdmin()
    {
        if (count(array_intersect($this->getRoles(), array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN'))) > 0) {
            return true;
        }

        return false;
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->fields)) {
            $this->fields[$name] = $value;
        }
        throw new \RuntimeException("{$name} is not exist in CurrentUser.");
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->fields[$name];
        }
        throw new \RuntimeException("{$name} is not exist in CurrentUser.");
    }

    public function __isset($name)
    {
        return isset($this->fields[$name]);
    }

    public function __unset($name)
    {
        unset($this->fields[$name]);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->__set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return $this->__unset($offset);
    }
}
