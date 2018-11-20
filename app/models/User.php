<?php

use Phalcon\Mvc\Model;
use Phalcon\Di;

class User extends Model
{
    private $id;
    private $login;
    private $password;
    private $name;
    private $active;
    private $role;
    private $sort;

    public function getSource(): string
    {
        return 'users';
    }

    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getActive(): bool
    {
        return intval($this->active) === 1 ? true : false;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setId(int $value)
    {
        $this->id = $value;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    public function setActive(bool $active)
    {
        if ($active === true) {
            $this->active = 1;
        } else {
            $this->active = 0;
        }
    }

    public function setRole(string $role)
    {
        if ($role !== 'admin' && $role !== 'editor') {
            throw new UnexpectedValueException('unknown role');
        }
        $this->role = $role;
    }

    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }

    public function getLinkBackendEdit(): string
    {
        return Di::getDefault()
            ->get('url')
            ->get([
                'for' => 'backend/user/item_action',
                'action' => 'edit',
                'user_id' => $this->getId(),
            ]);
    }

    public function getLinkBackendDelete(): string
    {
        return Di::getDefault()
            ->get('url')
            ->get([
                'for' => 'backend/user/item_action',
                'action' => 'delete',
                'user_id' => $this->getId(),
            ]);
    }
}


