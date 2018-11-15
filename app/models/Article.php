<?php

use Phalcon\Mvc\Model;
use Phalcon\Di;

class Article extends Model
{
    private $id;
    private $title_uk;
    private $title_en;
    private $text_uk;
    private $text_en;
    private $sort;
    private $author_id;

    public function getSource(): string
    {
        return 'articles';
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

    public function getSort(): int
    {
        return $this->sort;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
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

    public function getImageLink(): string
    {
        return Di::getDefault()->get('url')->getStatic('content/photo' . $this->getId() . '.jpg');
    }

    public function getLink(): string
    {
        return Di::getDefault()->get('url')->get([
            'for' => 'article/show',
            'language' => Di::getDefault()->get('lang')->getCurrent()->getId(),
            'article_id' => $this->getId(),
        ]);
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

    public function setSort(int $sort)
    {
        $this->sort = $sort;
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

    public function setAuthorId(int $author_id)
    {
        $this->author_id = $author_id;
    }

    public function getLinkBackendEdit(): string
    {
        return Di::getDefault()
            ->get('url')
            ->get([
                'for' => 'backend/article/item_action',
                'action' => 'edit',
                'page_id' => $this->getId(),
            ]);
    }

    public function getLinkBackendDelete(): string
    {
        return Di::getDefault()
            ->get('url')
            ->get([
                'for' => 'backend/article/item_action',
                'action' => 'delete',
                'page_id' => $this->getId(),
            ]);
    }
}




