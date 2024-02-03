<?php

namespace Esign;

use Esign\Exceptions\ApiException;
use Esign\HttpClient\GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ApiRequestor
{
    private static $_httpClient;

    /**
     * Send request and process response
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function request(string $method, string $url, array $params = [], array $headers = []): array
    {
        return self::_requestRaw($method, $url, $params, $headers);
    }

    /**
     * Send request and process response MultiPart Form Data (Multipart)
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return array
     * @throws ApiException|GuzzleException
     */
    public static function requestMultipart(string $method, string $url, array $params = []): array
    {
        return self::_requestMultiPart($method, $url, $params);
    }

    /**
     * @throws ApiException
     * @throws GuzzleException
     */
    private static function _requestRaw($method, $url, array $params, array $headers): array|ResponseInterface
    {
        $defaultHeaders = self::_setDefaultHeaders($headers);

        return self::_httpClient()->request($method, $url, [
            'headers' => $defaultHeaders,
            'json' => $params
        ]);
    }

    private static function _setDefaultHeaders(array $headers): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(Esign::$auth)
        ];

        return array_merge($defaultHeaders, $headers);
    }

    /**
     * Create HTTP Client
     *
     * @return GuzzleClient
     */
    public static function _httpClient(): GuzzleClient
    {
        if (!self::$_httpClient) {
            self::$_httpClient = GuzzleClient::instance();
        }
        return self::$_httpClient;
    }

    /**
     * GuzzleClient Setter
     *
     * @param GuzzleClient $client
     *
     * @return void
     */
    public static function setHttpClient(GuzzleClient $client): void
    {
        self::$_httpClient = $client;
    }

    /**
     * @throws ApiException
     */
    private static function _requestMultiPart(string $method, string $url, array $params): array
    {
        $defaultHeaders = [
            'Authorization' => 'Basic ' . Esign::$auth
        ];

        return self::_httpClient()->requestMultipart($method, $url, $defaultHeaders, $params);
    }
}