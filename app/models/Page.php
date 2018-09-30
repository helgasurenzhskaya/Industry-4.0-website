<?php

use Phalcon\Mvc\Model;

class Page extends Model 
{
    private $id;
    private $text_uk;
    private $text_en;
    private $name;
    private $sort;

    public function getSource(): string
    {
        return 'pages';
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getText($lang) 
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setId(int $value)
    {
        $this->id = $value;
    }

    public function setText($lang) 
    {

    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }
}
