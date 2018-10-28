<?php
namespace Backend;

use Phalcon\Mvc\User\Component as MvcUserComponent;
use \User;
use \Exception;

class Auth extends MvcUserComponent
{
    public function check($login, $password)
    {
        $user = User::findFirst([
            'conditions' => 'login = :user:',
            'bind' => [
                'user' => $login,
            ],
        ]);

        if ($user == false) {
            throw new Exception('error.login-password');
        }

        // Check the password.
        if ($this->security->checkHash($password, $user->getPassword()) == false) {
            throw new Exception('error.login-password');
        }

        $this->session->set('auth-identity', [
            'user' => $user,
        ]);
    }

    public function isLoggedIn(): bool
    {
        return $this->session->has('auth-identity');
    }

    public function remove(): void
    {
        $this->session->remove('auth-identity');
    }

    public function getUser(): User
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['user'])) {
            return $identity['user'];
        }

        return false;
    }
}
