<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Between;

class UserAddEditForm extends Form
{

    public function initialize()
    {
        if ($this->getEntity()->getId() === null) {
            $this->setAction($this->url->get([
                'for' => 'backend/user/add',
            ]));
        } else {
            $this->setAction($this->url->get([
                'for' => 'backend/user/item_action',
                'action' => 'edit',
                'user_id' => $this->getEntity()->getId(),
            ]));
        }

            $name = new Text('$name');
            $name->setLabel('Name');
            $name->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Name" field.',
                ]),
                new StringLength([
                    'max' => 255,
                    'min' => 2,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                    'messageMinimum' => 'Can not be shorter than 2 characters.',
                ]),
            ]);

            $this->add($name);
               

           $login = new Text('$login');
            $login->setLabel('Login');
            $login->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Login" field.',
                ]),
                new StringLength([
                    'max' => 255,
                    'min' => 2,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                    'messageMinimum' => 'Can not be shorter than 2 characters.',
                ]),
            ]);

            $this->add($login);
        
            
            $id = new Text('$id');
            $id->setLabel('Id');
            $id->addValidators([
                new PresenceOf([
                    'message' => 'Please fill "Id" field.',
                ]),
                new StringLength([
                    'max' => 255,
                    'min' => 2,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                    'messageMinimum' => 'Can not be shorter than 2 characters.',
                ]),
            ]);

            $this->add($id);  
            

            
            $sort = new Numeric('$sort');
            // fix
            $sort->setLabel('Sort');
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

            //add password and role
       
    }
}

