<?php

declare(strict_types = 1);

namespace App\Module\Face\Controller;

use Light\ErrorController;
use Light\Front;

class Error extends ErrorController
{
    public function index()
    {
        if (Front::getInstance()->getConfig()['light']['exception'] ?? false) {

            return var_export([

                'status'  => $this->getException()->getCode(),
                'message' => $this->getException()->getMessage(),
                'trace'   => $this->getException()->getTraceAsString(),

                'method' => $this->getRequest()->getMethod(),
                'params' => [
                    'get' => $this->getRequest()->getGetAll(),
                    'post' => $this->getRequest()->getPostAll()
                ]
            ], true);
        }

        return var_export(['error' => 'Some error occurred'], true);
    }
}