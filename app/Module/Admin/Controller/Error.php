<?php

declare(strict_types = 1);

namespace App\Module\Admin\Controller;

use Light\ErrorController;

class Error extends ErrorController
{
    public function index()
    {
        if ($this->isExceptionEnabled()) {

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