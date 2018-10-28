<?php

use Phalcon\Mvc\Model;
use Phalcon\Di;

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

    public function getText($lang = null): string
    {
        $tmp_field = 'text_';

        if (is_null($lang) === true) {
            $lang_service = Di::getDefault()->get('lang');
            $lang = $lang_service->getCurrent();
        }

        if (gettype($lang) === 'string') {
            $tmp_field = $tmp_field . $lang;
        } else if ($lang instanceof Lang === true) {
            $tmp_field = $tmp_field . $lang->getId();
        } else {
            throw new Exception('wrong lang');
        }

        return $this->$tmp_field;
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

    public function setText(string $value, $lang)
    {
        $tmp_field = 'text_';

        if (gettype($lang) === 'string') {
            $tmp_field = $tmp_field . $lang;
        } else if ($lang instanceof Lang === true) {
            $tmp_field = $tmp_field . $lang->getId();
        }

        $this->$tmp_field = $value;
    }


    public function setName(string $name)
    {
        $this->name = $name;
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
                'for' => 'backend/page/item_action',
                'action' => 'edit',
                'page_id' => $this->getId(),
            ]);
    }

    public function getLinkBackendDelete(): string
    {
        return Di::getDefault()
            ->get('url')
            ->get([
                'for' => 'backend/page/item_action',
                'action' => 'delete',
                'page_id' => $this->getId(),
            ]);
    }
}
