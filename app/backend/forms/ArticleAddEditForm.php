<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\File as FileValidator;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class ArticleAddEditForm extends Form
{

    public function initialize()
    {
        if ($this->getEntity()->getId() === null) {
            $this->setAction($this->url->get([
                'for' => 'backend/article/add',
            ]));
        } else {
            $this->setAction($this->url->get([
                'for' => 'backend/article/item_action',
                'action' => 'edit',
                'article_id' => $this->getEntity()->getId(),
            ]));
        }

        $langs = $this->lang->getAll();
        foreach ($langs as $lang) {
            $name = new Text('title_' . $lang->getId());
            $name->setLabel('Title ' . $lang->getId());
            $name->setAttribute('required', 'required');
            $name->addValidators([
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

            $this->add($name);

            $text = new TextArea('text_' . $lang->getId());
            $text->setLabel('Text ' . $lang->getId());
            $text->setAttribute('required', 'required');
            $text->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Text ' . $lang->getId() . '" field.',
                ]),
                new StringLength([
                    'max' => 65000,
                    'messageMaximum' => 'Can not be longer than 65000 characters.',
                ]),
            ]);

            $this->add($text);
        }

        $file = new File('image');
        $file->setLabel('Image');
        // if ($this->request->hasFiles(true)) {
        //     $file->addValidators([
        //         new FileValidator([
        //             'maxSize' => '2M',
        //             'messageSize' => ':field exceeds the max filesize (:max)',
        //             'allowedTypes' => [
        //                 'image/jpeg',
        //                 'image/png',
        //             ],
        //             'messageType' => 'Allowed file types are :types',
        //             'maxResolution' => '1920X1277',
        //             'minResolution' => '752X500',
        //             'messageMaxResolution' => 'Max resolution of :field is :max',
        //         ]),
        //     ]);
        // }

        $this->add($file);

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
