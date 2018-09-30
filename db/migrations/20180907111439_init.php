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
        $menus->addColumn('sort', 'integer');
        $menus->create();

        $pages = $this->table('pages');
        $pages->addColumn('name', 'string');
        $pages->addColumn('text_uk', 'string');
        $pages->addColumn('text_en', 'string');
        $pages->addColumn('sort', 'integer');
        $pages->create();
    }
}
