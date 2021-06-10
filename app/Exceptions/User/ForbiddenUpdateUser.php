<?php

namespace App\Exceptions\User;

use App\Exceptions\ForbiddenException;

class ForbiddenUpdateUser extends ForbiddenException
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Forbidden to update user.';
}
