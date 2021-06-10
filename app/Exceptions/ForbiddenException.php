<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends StatusCodeException
{
    /**
     * Response status code.
     *
     * @var int
     */
    protected $statusCode = 403;
}
