<?php

namespace Esign\Exceptions;

use Exception;

class ApiException extends Exception implements ExceptionInterface
{
    private string $errorCode;

    /**
     * @inheritDoc
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Create a new instance of ApiException
     *
     * @param string $message
     * @param int $code
     * @param string $errorCode
     * @throws ApiException
     */
    public function __construct(string $message, int $code, $errorCode)
    {
        if(empty($message)) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
        $this->errorCode = $errorCode;
    }
}