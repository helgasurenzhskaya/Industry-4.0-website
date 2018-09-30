<?php

use Phalcon\Mvc\Model;

class User extends Model 
{
    private $id;
    private $login;
    private $password;
    private $name;
    private $active;
    private $sort;

    public function getSource(): string
    {
        return 'users';
    }

    public function getId(): int 
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLogin(): string 
    {
        return $this->login;
    }

    public function getActive(): bool
    {
        return $this->active === 1 ? true : false;
    }

    public function getSort():int
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

    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }

}


