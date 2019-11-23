<?php

namespace App\Module\Admin\Controller;

use Light\Front;

class Storage extends \Light\Crud\Storage
{
    public function init()
    {
        parent::init();

        if ($this->getRequest()->isAjax()) {
            $this->getView()->setLayoutEnabled(false);
        }
    }

    public function index()
    {
        return '<iframe class="storage-container" src="/' . Front::getInstance()->getConfig()['light']['storage']['route'] . '"></iframe>';
    }
}