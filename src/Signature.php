<?php

namespace Esign;

use Esign\ApiOperation\Create;
use Esign\ApiOperation\Request;
use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;

class Signature implements SignatureInterface
{
    use Create, Request;


    /**
     * Instantiate required params for Create
     *
     * @return array
     */
    public static function signReqParams(): array
    {
        return [
            'file',
            'nik',
            'passphrase',
            'tampilan',
            'height',
            'width',
            'linkQR',
            'tag_koordinat'
        ];
    }

    /**
     * Send Post Request to create signature
     *
     * @param array $params
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function sign(array $params): array
    {
        $uri = Esign::$baseUrl . '/sign/pdf';
        static::_validateParams($params, static ::signReqParams());

        return static::_requestMultipart('POST', $uri, $params);
    }

    /**
     * Instantiate required params for Verify
     *
     * @return array
     */
    public static function verifyReqParams(): array
    {
        return [
            'signed_file'
        ];
    }

    /**
     * Send POST Request to verify signature
     *
     * @param array $params
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function verify(array $params): array
    {
        $uri = Esign::$baseUrl . '/sign/verify';
        static::_validateParams($params, static::verifyReqParams());

        return static::_requestMultipart('POST', $uri, $params);

    }

}