<?php

namespace App\Exceptions;

class NotFoundException extends StatusCodeException
{
    /**
     * Response status code.
     *
     * @var int
     */

     protected $statusCode = 404;
}
