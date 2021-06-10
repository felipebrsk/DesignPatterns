<?php

namespace Tests\Feature\Feature\Http\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FakerUser;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    use RefreshDatabase, FakerUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->auth->login(
            $this->createFakerUser()
        );
    }

    /**
     * Test if an user can sign out with response ok.
     */
    public function test_if_an_user_can_sign_out() {
        $this->postJson('/api/v1/auth/logout')->assertOk();
    }

    /**
     * Test if sign out invalidate authentication.
     */
    public function test_if_sign_out_invalidate_authentication() {
        $this->postJson('/api/v1/auth/logout');

        $this->assertGuest();
    }
}