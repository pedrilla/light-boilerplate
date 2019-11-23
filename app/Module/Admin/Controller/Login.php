<?php

namespace App\Module\Admin\Controller;

use App\Module\Admin\Service\Auth;
use Light\Controller;
use Light\Filter\Trim;
use Light\Front;

class Login extends Controller
{
    public function index()
    {
        $this->getView()->setLayoutEnabled(false);

        if ($this->getRequest()->isPost()) {

            $login = (new Trim())->filter($this->getRequest()->getPost('login'));
            $password = (new Trim())->filter($this->getRequest()->getPost('password'));

            $config = Front::getInstance()->getConfig()['admin'];

            if ($config['login'] == $login && $config['password'] == $password) {
                Auth::getInstance()->set($config);
                $this->redirect($this->getRouter()->assemble(['controller' => 'index']));
            }

            $this->getView()->assign('error', true);
        }
    }

    public function logout()
    {
        Auth::getInstance()->remove();
        $this->redirect($this->getRouter()->assemble(['action' => 'index']));
    }
}