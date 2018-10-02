<?php

use Phinx\Migration\AbstractMigration;

class Articles extends AbstractMigration
{
    public function change()
    {
        $users = $this->table('users');
        $users->addColumn('login', 'string', ['limit' => 32]);
        $users->addColumn('name', 'string', ['limit' => 32]);
        $users->addColumn('password', 'string', ['limit' => 32]);
        $users->addColumn('active', 'integer', ['default' => 1]);
        $users->addColumn('role', 'enum', ['values' => ['admin', 'manager']]);
        $users->addIndex('login', ['unique' => true]);

        $olgaId = 1;
        $users->insert([
            'id' => $olgaId,
            'login' => 'olgafereal',
            'name' => 'Olga',
            'password' => '',
            'role' => 'admin',
        ]);
        
        $users->create();

        $articles = $this->table('articles');
        $articles->addColumn('author_id', 'integer');
        $articles->addColumn('title_uk', 'string');
        $articles->addColumn('title_en', 'string');
        $articles->addColumn('image', 'string', ['null' => true]);
        $articles->addColumn('text_uk', 'text');
        $articles->addColumn('text_en', 'text');
        $articles->addColumn('sort', 'integer', ['default' => 100]);
        $articles->addForeignKey('author_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $articles->insert([
            [
            'author_id' => $olgaId,
            'title_uk' => 'Кіберфізичні системи',
            'title_en' => 'Cyber-physical systems',
            // 'image' => '',
            'text_uk' => '',
            'text_en' => '',
            ],
            [
                'author_id' => $olgaId,
                'title_uk' => 'Аналіз великих даних',
                'title_en' => 'Big data analysis',
                // 'image' => '',
                'text_uk' => '',
                'text_en' => '',
            ],
            [
                'author_id' => $olgaId,
                'title_uk' => 'Інтернет речей',
                'title_en' => 'Internet of things',
                // 'image' => '',
                'text_uk' => '',
                'text_en' => '',
            ],
            [
                'author_id' => $olgaId,
                'title_uk' => 'Штучний інтелект',
                'title_en' => 'Artificial intelligence',
                // 'image' => '',
                'text_uk' => '',
                'text_en' => '',
            ],            
        ]);

        $articles->create();
    }
}
