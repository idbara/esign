<?php

namespace Esign\Tests;

use Esign\ApiRequestor;
use Esign\Esign;
use Esign\HttpClient\GuzzleClient;

class TestCase extends \PHPUnit\Framework\TestCase
{
    private string $user = '';
    private string $password = '';
    private string $baseUrl = 'http://103.18.188.141/api';


    public function setUp(): void
    {
        $this->esign = new Esign($this->user, $this->password, $this->baseUrl);
        $guzzleClient = GuzzleClient::instance();
        ApiRequestor::setHttpClient($guzzleClient);
    }

}