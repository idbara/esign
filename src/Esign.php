<?php

namespace Esign;

use GuzzleHttp\Client;

class Esign
{
    protected $user;
    protected $password;
    public static $baseUrl;
    protected $_httpClient;
    public static $auth;


    public function __construct($user, $password, $baseUrl)
    {
        $this->_httpClient = new Client();
        $this->user = $user;
        $this->password = $password;
        self::$baseUrl = $baseUrl;
        self::$auth = base64_encode($this->user . ':' . $this->password);
    }

}