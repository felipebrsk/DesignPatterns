<?php

namespace App\Exceptions\Auth;

use App\Exceptions\UnauthorizedException;

class InvalidCredentialsException extends UnauthorizedException
{
    public $message = 'Invalid credentials.';
}
