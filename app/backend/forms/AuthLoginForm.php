<?php
namespace Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;

class AuthLoginForm extends Form
{

    public function initialize()
    {
        $login = new Text('login');
        $login->setLabel('Login');
        $login->addValidators([
            new PresenceOf([
                'message' => 'Please fill "Login" field.',
            ]),
            new StringLength([
                'max' => 200,
                'min' => 2,
                'messageMaximum' => 'Login can not be longer than 200 characters.',
                'messageMinimum' => 'Login can not be shorter than 2 characters.',
            ]),
        ]);

        $this->add($login);

        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password can not be empty.',
            ]),
            new StringLength([
                'max' => 200,
                'messageMaximum' => 'Login can not be longer than 200 characters.',
            ]),
        ]);

        $this->add($password);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'Please, refresh page and try again.',
        ]));

        $this->add($csrf);
    }
}
