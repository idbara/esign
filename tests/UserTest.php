<?php

namespace Esign\Tests;

use Esign\Exceptions\ApiException;
use Esign\User;
use GuzzleHttp\Exception\GuzzleException;

class UserTest extends TestCase
{

    /**
     * @throws ApiException|GuzzleException
     */
    public function testStatus()
    {
        $response = User::status('3327011810810001');
//        fwrite(STDERR, print_r($response, TRUE));
        $this->assertArrayHasKey('status_code', $response);
        $this->assertEquals(200, $response['status_code']);
    }
}
