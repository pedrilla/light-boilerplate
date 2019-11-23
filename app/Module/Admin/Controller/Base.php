<?php

declare(strict_types = 1);

namespace App\Module\Admin\Controller;

use App\Module\Admin\Service\Auth;
use Light\Controller;

abstract class Base extends Controller
{
    public function init()
    {
        parent::init();

        if (!Auth::getInstance()->hasIdentity()) {
            $this->redirect(
                $this->getRouter()->assemble(['controller' => 'login'])
            );
        }

        if ($this->getRequest()->isAjax()) {
            $this->getView()->setLayoutEnabled(false);
        }
    }
}

