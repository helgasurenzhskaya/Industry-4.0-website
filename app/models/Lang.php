<?php

use Phalcon\Mvc\Model;

class Lang extends Model 
{
   private $id; /**use ISO 639-1 code */
   private $title;
   private $sort;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value)
    {
        $this->id = $value;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }
}


