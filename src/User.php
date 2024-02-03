<?php

namespace Esign;

use Esign\ApiOperation\Request;
use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;

class User
{
    use Request;


    /**
     * Send Get Request to check if user is valid
     *
     * @param string $nik
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function status(string $nik): array
    {
        $uri = Esign::$baseUrl . '/user/status/' . $nik;
        return static::_request('GET', $uri);

    }
}