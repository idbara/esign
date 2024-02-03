<?php

namespace Esign\HttpClient;

use Psr\Http\Message\ResponseInterface;

interface ResponseHandlerInterface
{
    /**
     * Handle the response
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function handle(ResponseInterface $response): array;

}