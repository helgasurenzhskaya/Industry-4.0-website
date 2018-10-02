<?php

use Phalcon\Mvc\Model;
use Phalcon\Di;

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

    public function getTitle($lang = null): string
    {
        $tmp_field = 'title_';

        if (is_null($lang) === true) {
            $lang_service = Di::getDefault()->get('lang');
            $lang = $lang_service->getCurrent();
        }

        if (gettype($lang) === 'string') {
            $tmp_field = $tmp_field . $lang;
        } else if ($lang instanceof Lang === true) {
            $tmp_field = $tmp_field . $lang->getId();
        } else {
            throw new TypeError('wrong lang type');
        }

        if (property_exists($this, $tmp_field) === false) {
            throw new UnexpectedValueException('unknown lang');
        }

        return $this->$tmp_field;
    }

    public function getUrl(): string 
    {
        return $this->url;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setId(int $value)
    {
        $this->id = $value;
    }

    public function setTitle(string $value, $lang) 
    {
        $tmp_field = 'title_';

        if (gettype($lang) === 'string') {
            $tmp_field = $tmp_field . $lang;
        } else if ($lang instanceof Lang === true) {
            $tmp_field = $tmp_field . $lang->getId();
        }

        $this->$tmp_field = $value;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }
}


