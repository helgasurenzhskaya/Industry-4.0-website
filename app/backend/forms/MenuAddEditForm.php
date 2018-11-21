<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class MenuAddEditForm extends Form
{

    public function initialize()
    {
        $langs = $this->lang->getAll();
        foreach ($langs as $lang) {
            $title = new Text('title_' . $lang->getId());
            $title->setLabel('Title ' . $lang->getId());
            $title->setAttribute('required', 'required');
            $title->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Title ' . $lang->getId() . ' " field.',
                ]),
                new StringLength([
                    'max' => 255,
                    'min' => 2,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                    'messageMinimum' => 'Can not be shorter than 2 characters.',
                ]),
            ]);

            $this->add($title);

            $url = new Text('url_' . $lang->getId());
            $url->setLabel('Url ' . $lang->getId());
            $url->setAttribute('required', 'required');
            $url->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Url ' . $lang->getId() . ' " field.',
                ]),
                new StringLength([
                    'max' => 255,
                    'min' => 1,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                    'messageMinimum' => 'Can not be shorter than 1 characters.',
                ]),
            ]);

            $this->add($url);
        }

        $sort = new Numeric('sort');
        $sort->setLabel('Sort');
        $sort->setAttribute('required', 'required');
        $sort->addValidators([
            new PresenceOf([
                'message' => 'Please fill "Sort".',
            ]),
            new Numericality([
                'message' => ':field is not numeric.',
            ]),
            new Between([
                'minimum' => 0,
                'maximum' => 65000,
                'message' => 'The :field must be between 0 and 65000.',
            ])
        ]);

        $this->add($sort);
    }

}
