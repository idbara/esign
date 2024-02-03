<?php

namespace Esign\HttpClient;

use Esign\Esign;
use Esign\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements ClientInterface
{
    private static $_instance;
    protected Guzzle $http;
    protected ?ResponseHandlerInterface $responseHandler = null;

    /**
     * Esign Client Constructor
     */
    public function __construct()
    {
        $this->http = new Client([
            'base_uri' => Esign::$baseUrl,
            'timeout' => 60,
            'verify' => false,
        ]);
        // set response handler
        $this->setResponseHandler(new ResponseHandler());
    }

    /**
     * @inheritDoc
     * @throws ApiException
     */
    public function request(string $method, string $uri = '', array $options = []): array
    {
        $method = strtoupper($method);
        $options['headers']['Authorization'] = 'Basic ' . Esign::$auth;

        return $this->_executeRequest($method, $uri, $options);
    }

    private function setResponseHandler(ResponseHandlerInterface $responseHandler): void
    {
        $this->responseHandler = $responseHandler;
    }

    /**
     * Create Client instance
     *
     * @return GuzzleClient
     */
    public static function instance(): GuzzleClient
    {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @throws ApiException
     */
    private function _executeRequest($method, $uri, array $options)
    {
        try {
            $response = $this->http->request($method, $uri, $options);
            return $this->responseHandler->handle($response);
        } catch (RequestException $e) {
            return $this->responseHandler->handleError($e->getResponse());
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }


    /**
     * Create a request multipart to execute in _executeRequest
     *
     * @param string $method request method
     * @param string $uri request uri
     * @param array $params parameters
     *
     * @param array $defaultHeaders request headers
     * @return array
     * @throws ApiException
     */
    public function requestMultipart(string $method, string $uri, array $defaultHeaders = [], array $params = []): array
    {
        $method = strtoupper($method);
        $options = [];
        $options['headers'] = $defaultHeaders;
        $options['method'] = $method;
        $options['multipart'] = $this->buildMultipartData($params);

        return $this->_executeRequest($method, $uri, $options);
    }

    /**
     * Build the multipart data array.
     *
     * @param $params
     * @return array
     */
    private function buildMultipartData($params): array
    {
        $multipart = [];
        foreach ($params as $name => $contents) {
            $multipart[] = [
                'name' => $name,
                'contents' => $contents,
            ];
        }
        return $multipart;
    }

}