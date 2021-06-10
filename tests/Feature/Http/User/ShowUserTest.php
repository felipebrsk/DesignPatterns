<?php

namespace Tests\Feature\Http\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\FakerUser;

class ShowUserTest extends TestCase
{
    use RefreshDatabase, FakerUser;
    /**
     * Faker user.
     *
     * @var \App\Models\User
     */

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createFakerUser();
    }

    /**
     * Test if show user responds with 200 status code.
     */
    public function test_if_show_method_responds_with_ok()
    {
        $this->getJson("/api/v1/users/{$this->user->id}")->assertOk();
    }

    /**
     * Test if show user responds with 200 status code.
     */
    public function test_if_show_method_can_show_404_when_user_doesnt_exists()
    {
        $this->getJson('/api/v1/users/00000')->assertNotFound();
    }

    /**
     * Test if show user responds with attributes.
     */
    public function test_if_show_method_can_respond_with_correctly_attributes()
    {
        $this->getJson("/api/v1/users/{$this->user->id}")->assertJsonStructure([
            'data' => [
                'name',
                'CPF',
                'email',
                'birthday',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
