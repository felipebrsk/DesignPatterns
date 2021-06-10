<?php

namespace App\Exceptions;

class UnauthorizedException extends StatusCodeException
{
    /**
     * Response status code.
     *
     * @var int
     */
    
    protected $statusCode = 401;
}
