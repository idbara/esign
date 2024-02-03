<?php

namespace Esign\ApiOperation;

use Esign\ApiRequestor;
use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

trait Request
{
    /**
     * Parameters validation
     *
     * @param array $params
     * @param array $requiredParams
     *
     * @return void
     */
    protected static function _validateParams(array $params, array $requiredParams): void
    {
        $currParams = array_diff_key(array_flip($requiredParams), $params);
        if (count($currParams) > 0) {
            throw new InvalidArgumentException('Missing required params: ' . implode(', ', array_keys($currParams)));
        }
    }

    /**
     * Send a request to API Requester
     *
     * @param string $method
     * @param string $url
     * @param array $params
     *
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    protected static function _request(string $method, string $url, array $params = []): array
    {
        $requester = new ApiRequestor();
        return $requester->request($method, $url, $params);
    }
}