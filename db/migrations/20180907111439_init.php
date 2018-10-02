<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
{
    public function change()
    {
        $menus = $this->table('menus');
        $menus->addColumn('title_uk', 'string');
        $menus->addColumn('title_en', 'string');
        $menus->addColumn('url', 'string');
        $menus->addColumn('sort', 'integer', ['default' => 100]);

        $menus->insert([
            [
                'title_uk' => 'Головна',
                'title_en' => 'Home',
                'url' => '',
                'sort' => 10,
            ],
            [
                'title_uk' => 'Інформація',
                'title_en' => 'About',
                'url' => '#about',
                'sort' => 30,
            ],
            [
                'title_uk' => 'Напрямки',
                'title_en' => 'Directions',
                'url' => '#direction',
                'sort' => 50,
            ],
        ]);
        
        $menus->create();

        $pages = $this->table('pages');
        $pages->addColumn('name', 'string');
        $pages->addColumn('text_uk', 'text');
        $pages->addColumn('text_en', 'text');
        $pages->addColumn('sort', 'integer', ['default' => 100]);
        $pages->create();
    }
}
