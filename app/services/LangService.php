<?php

use Phalcon\Di;
use Phalcon\Http\Response\Cookies;

class LangService 
{
    private $default;
    private $langs;
    private $lang;

    function __construct($config) 
    {
        $this->langs = [];

        $config_count = count($config['langs']);
        for ($i = 0; $i < $config_count; $i++) {
            $lang = new Lang();
            // TODO: проверка на существование свойств
            $lang->setId($config['langs'][$i]['code']);
            $lang->setTitle($config['langs'][$i]['title']);
            $lang->setSort($i);
            array_push($this->langs, $lang);
        }
    }

    public function getCurrent(): Lang
    {
        if (!$this->lang) {
            return $this->detectLanguage();
        }
        return $this->lang;
    }
    
    public function getAll(): array
    {
        return $this->langs;
    }
    
    public function getByCode(string $code): Lang
    {
        foreach ($this->langs as $lang) {
            if ($lang->getId() === $code) {
                return $lang;
            }
        }

        return null;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function process()
    {
        if (!$this->lang) {
            $di = Di::getDefault();

            $this->lang = $this->detectLanguage();

            if ($di->has('cookies')) {
                $cookies = $di->get('cookies');
                $cookies->set('language', $this->lang, time() + 60 * 60 * 24 * 7 * 30);
            }

            if ($this->getDefault() != $this->lang
                && $this->lang != $di->getShared('dispatcher')->getParam('language')
                && $di->getShared('dispatcher')->getControllerName() != 'error'
            ) {
                $di->getShared('response')
                    ->redirect(
                        $di->getShared('url')->path(
                            $di->getShared('url')->get(
                                [
                                    'for' => 'home',
                                    'language' => $this->getCurrent(),
                                ]
                            )
                        )
                    )
                    ->send();
                die;
            }
        }
    }

    protected function detectLanguage(): Lang
    {
        $di = Di::getDefault();
        $tmp_lang = $di->getShared('dispatcher')->getParam('language');
        if (empty($tmp_lang)) {
            if ($di->has('cookies')) {
                $cookies = $di->get('cookies');
                if ($cookies->has('language')) {
                    $cookie_lang = $cookies->get('language');
                    $tmp_lang = $cookie_lang->getValue();
                }
            }
            if ($tmp_lang === null || $this->getByCode($tmp_lang) === null) {
                if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                    $tmp_lang_client = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                }
                if ($this->getByCode($tmp_lang_client) !== null) {
                    $tmp_lang = $tmp_lang_client;
                } else {
                    $tmp_lang = $this->getDefault();
                }
            }
        }
        // setlocale(LC_ALL,$this->getByCode($tmp_lang_client)->getLocale() . '.UTF-8');
        return $this->getByCode($tmp_lang);
    }
}
