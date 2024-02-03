<?php

namespace Esign\HttpClient;

use Psr\Http\Message\ResponseInterface;

class ResponseHandler implements ResponseHandlerInterface
{

    /**
     * Handle the response
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function handle(ResponseInterface $response): array
    {
        // if response header has Content-Disposition, then it's a file download
        if ($response->hasHeader('Content-Disposition')) {
            return [
                'status_code' => 200,
                'headers' => $response->getHeaders(),
                'body' => $response->getBody()->getContents(),
            ];
        }

        $getBody = $response->getBody()->getContents();
        $body = json_decode($getBody, true);
        $statusCode = $response->getStatusCode();
        $headers = $response->getHeaders();
        $getMessages = $response->getReasonPhrase();
        $messages = [
            'status_code' => $statusCode,
            'headers' => $headers,
            'messages' => $getMessages
        ];

        return [
            'status_code' => $statusCode,
            'headers' => $headers,
            'body' => $body ?? $messages,
        ];
    }

    /**
     * Handle the response for the error
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function handleError(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $headers = $response->getHeaders();
        return [
            'status_code' => $statusCode,
            'headers' => $headers,
            'body' => $response->getBody()->getContents(),
        ];
    }

    /**
     * Handle the response for object data / file download / stream response
     *
     * @param ResponseInterface $response
     * @return string
     */
    public function handleStream(ResponseInterface $response): string
    {
        return $response->getBody()->getContents();
    }
}