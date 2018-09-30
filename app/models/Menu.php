<?php

use Phalcon\Mvc\Model;

class Menu extends Model 
{
    private $id;
    private $title_uk;
    private $title_en;
    private $url;
    private $sort;

    public function getSource(): string
    {
        return 'menus';
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getTitle($lang) 
    {

    }

    public function getUrl() 
    {

    }

    public function getSort() 
    {

    }

    public function setId(int $value): void 
    {
        $this->id = $value;
    }

    public function setTitle($lang) 
    {

    }

    public function setUrl() 
    {

    }

    public function setSort() 
    {

    }
}
