<?php

namespace Esign\ApiOperation;

use Esign\ApiRequestor;
use Esign\Esign;
use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;

trait Create
{

    /**
     * @throws ApiException
     * @throws GuzzleException
     */
    private static function _requestMultipart(string $string, $url, array $params): array
    {
        $requester = new ApiRequestor();
        return $requester->requestMultipart($string, $url, $params);

    }

}