<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;

class PageAddEditForm extends Form
{

    public function initialize()
    {
        $name = new Text('name');
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'Please fill "Name" field.',
            ]),
            new StringLength([
                'max' => 255,
                'min' => 2,
                'messageMaximum' => 'Can not be longer than 255 characters',
                'messageMinimum' => 'Can not be shorter than 2 characters',
            ]),
        ]);

        $this->add($name);

        $langs = $this->lang->getAll();
        foreach ($langs as $lang) {
            $text = new TextArea('text_' . $lang->getId());
            $text->setLabel('Text ' . $lang->getId());
            $text->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Text ' . $lang->getId() . '" field.',
                ]),
                new StringLength([
                    'max' => 65000,
                    'messageMaximum' => 'Can not be longer than 65000 characters',
                ]),
            ]);

            $this->add($text);
        }
    }
}
