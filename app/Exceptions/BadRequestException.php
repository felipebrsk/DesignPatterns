<?php

namespace App\Exceptions;

class BadRequestException extends StatusCodeException
{
    /**
     * Response status code.
     *
     * @var int
     */

    protected $statusCode = 400;
}
