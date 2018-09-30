<?php

use Phinx\Migration\AbstractMigration;

class Articles extends AbstractMigration
{
    public function change()
    {
        $articles = $this->table('articles');
        $articles->addColumn('author_id', 'integer');
        $articles->addColumn('title_uk', 'string');
        $articles->addColumn('title_en', 'string');
        $articles->addColumn('image', 'string', ['null' => true]);
        $articles->addColumn('text_uk', 'string');
        $articles->addColumn('text_en', 'string');
        $articles->addColumn('sort', 'integer');
        $articles->create();

        $users = $this->table('users');
        $users->addColumn('login', 'string');
        $users->addColumn('name', 'string');
        $users->addColumn('password', 'string');
        $users->addColumn('active', 'integer');
        $users->addColumn('role', 'enum');
        $users->create();
    }
}
