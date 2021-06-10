<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Auth service.
     *
     * @var \App\Services\AuthService
     */

    private $service;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;

        $this->middleware('auth')->only(['logout', 'me', 'refresh']);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request) {
        $token = $this->service->login(
            $request->validated()
        );

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return ApiResponse::successMessage(Auth::user(), 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->service->logout();

        return ApiResponse::successMessage('A sua sessão foi encerrada com sucesso.', 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::user()->refresh);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return ApiResponse::successMessage([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 1200
        ], 200);
    }
}