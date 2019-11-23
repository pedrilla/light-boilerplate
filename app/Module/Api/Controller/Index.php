<?php

declare(strict_types = 1);

namespace App\Module\Api\Controller;

class Index extends Base
{
    public function index()
    {
        return [
            'ping' => 'pong'
        ];
    }
}