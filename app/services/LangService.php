<?php
class LangService 
{
    private $lang;

    function __construct($config) 
    {
        $this->langs = [];

        $config_count = count($config);
        for ($i = 0; $i < $config_count; $i++) {
            $lang = new Lang();
            // TODO: проверка на существование свойств
            $lang->setId($config[$i]['code']);
            $lang->setTitle($config[$i]['title']);
            $lang->setSort($i);
            array_push($this->langs, $lang);
        }
    }

    public function getCurrent(): Lang
    {
        return $this->langs[0];
    }
    
    public function getAll(): array
    {
        return $this->langs;
    }
}
