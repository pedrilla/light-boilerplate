<?php

declare(strict_types = 1);

namespace App\Module\Admin\Service;

use Light\Cookie;

class Auth
{
    /**
     * @var Auth
     */
    private static $instance = null;

    /**
     * @return Auth
     */
    public static function getInstance(): Auth
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @var mixed
     */
    public $identity = null;

    /**
     * @var string
     */
    private $_cookieName = 'auth_identity';

    /**
     * Auth constructor.
     */
    private function __construct()
    {
        $this->identity = Cookie::get($this->_cookieName);
    }

    /**
     * @return bool
     */
    public function hasIdentity(): bool
    {
        return $this->identity !== null;
    }

    /**
     * @param $identity
     * @return bool
     */
    public function set($identity)
    {
        $this->identity = $identity;
        return Cookie::set($this->_cookieName, $identity);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->identity;
    }

    /**
     * @return bool
     */
    public function remove()
    {
        $this->identity = null;
        return Cookie::remove($this->_cookieName);
    }
}