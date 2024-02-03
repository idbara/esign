<?php

namespace Esign\Exceptions;

interface ExceptionInterface
{
    /**
     * Get error code for the exception instance
     *
     * @return string
     */
    public function getErrorCode(): string;

}