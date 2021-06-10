<?php

namespace App\Services;

use App\Exceptions\Auth\InvalidCredentialsException;

use Illuminate\Contracts\Auth\Factory as Auth;

class AuthService {
    /**
     * Auth factory.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */

    private $auth;

    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    /**
     * Get user id.
     *
     * @return string
     */
    public function get_user_id(): string {
        return $this->auth->guard()->id();
    }

    /**
     * Check if the specified user id is the owner user id. (Change repository logic to service later)
     *
     * @return boolean
     */
    public function isOwner($id): bool {
        return $id === $this->get_user_id();
    }

    /**
     * Sign user into application if credentials are valid.
     *
     * @throws \App\Exceptions\Auth\InvalidCredentialsException
     */
    public function login(array $credentials): ?string {
        $token = $this->auth->guard()->attempt($credentials);

        if (!$token) {
            throw new InvalidCredentialsException();
        }

        return $token;
    }

    /**
     * Sign out application.
     */
    public function logout() {
        $this->auth->guard()->logout();
    }
}