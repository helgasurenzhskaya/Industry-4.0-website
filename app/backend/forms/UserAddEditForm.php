<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

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

            $name = new Text('name');
            $name->setLabel('Name');
            $name->setAttribute('required', 'required');
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


            $login = new Text('login');
            $login->setLabel('Login');
            $login->setAttribute('required', 'required');
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

            $active = new Check('active');
            $active->setAttribute('value', true);
            $active->setLabel('Active');

            $this->add($active);

            $role = new Select('role');
            $role->setLabel('Role');
            $role->setOptions([
                'editor' => 'Editor',
                'admin' => 'Admin',
            ]);
            $role->setDefault('editor');

            $this->add($role);

            $password_1 = new Password('password_1');
            $password_1->setLabel('Password');
            $password_1->addValidators([
                new Confirmation([
                    'with' => 'password_2',
                ]),
                new StringLength([
                    'max' => 255,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                ]),
            ]);

            $this->add($password_1);

            $password_2 = new Password('password_2');
            $password_2->setLabel('Re password');
            $password_2->addValidators([
                new StringLength([
                    'max' => 255,
                    'messageMaximum' => 'Can not be longer than 255 characters.',
                ]),
            ]);

            $this->add($password_2);

            if ($this->getEntity()->getId() === null) {
                $password_1->addValidator(new PresenceOf());
                $password_2->addValidator(new PresenceOf());
            }
    }
}

