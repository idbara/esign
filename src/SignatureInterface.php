<?php

namespace Esign;

use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Stream;

interface SignatureInterface
{
    /**
     * Send Post Request to create signature
     *
     * @param array $params
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function sign(array $params): array;

    /**
     * Send POST Request to verify signature
     *
     * @param array $params
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function verify(array $params): array;

}