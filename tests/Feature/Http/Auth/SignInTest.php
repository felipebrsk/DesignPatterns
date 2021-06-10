<?php

namespace Tests\Feature\Http\Auth;

use Tests\FakerUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignInTest extends TestCase 
{
    use RefreshDatabase, FakerUser;

    private $credentials;

    /**
     *  SetUp User test credentials;
     * 
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->credentials = [
            'email' => 'fakeruser@gmail.com',
            'password' => 'admin1234',
        ];
    }

    /**
     *  Test if sign in returns status code 200 if user exists.
     */
    public function test_if_user_can_sign_in()
    {
        $this->createFakerUser($this->credentials);

        $this->postJson('/api/v1/auth/login', $this->credentials)->assertOk();
    }
    
    /**
     *  Test if sign in returns status code 401 if user doesn't exists.
     */
    public function test_if_user_isnt_authorized_to_sign_in_if_doesnt_exists()
    {
        $this->postJson('/api/v1/auth/login', $this->credentials)->assertUnauthorized();
    }
    
    /**
     * Test if an user receives valid credentials.
     */
    public function test_if_an_user_can_receive_valid_credentials() {
        $user = $this->createFakerUser($this->credentials);
        
        $this->postJson('/api/v1/auth/login', $this->credentials);
        
        $this->assertAuthenticatedAs($user);
    }
}
