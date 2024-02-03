<?php

namespace Esign\HttpClient;

use Esign\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;

interface ClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws GuzzleException
     */
    public function request(string $method, string $uri = '', array $options = []): array;

    /**
     * Create a request multipart to execute in _executeRequest
     *
     * @param string $method request method
     * @param string $uri request uri
     * @param array $params parameters
     *
     * @param array $defaultHeaders request headers
     * @throws ApiException
     */
    public function requestMultipart(string $method, string $uri, array $defaultHeaders = [], array $params = []);

}