<?php

declare(strict_types = 1);

namespace App\Module\Api\Controller;

use Light\ErrorController;

class Error extends ErrorController
{
    public function index()
    {
        if ($this->isExceptionEnabled()) {

            return [

                'status'  => $this->getException()->getCode(),
                'message' => $this->getException()->getMessage(),
                'trace'   => $this->getException()->getTraceAsString(),

                'method' => $this->getRequest()->getMethod(),
                'params' => [
                    'get' => $this->getRequest()->getGetAll(),
                    'post' => $this->getRequest()->getPostAll()
                ]
            ];
        }

        return [
            'error' => 'Some error'
        ];
    }
}