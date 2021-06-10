<?php

namespace Tests\Feature\Http\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\FakerUser;

class DestroyUserTest extends TestCase
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

        $this->user = $this->actingAsFakerUser();
    }

    /**
     * Test if destroy user assert that's ok.
     */
    public function test_if_can_delete_an_user() {
        $this->deleteJson("/api/v1/users/{$this->user->id}")->assertOk();
    }

    /**
     * Test if destroy user responds with forbidden when try to delete another user.
     */
    public function test_if_destroy_method_return_forbidden_when_try_to_delete_another_user() {
        $another = $this->createFakerUser();

        $this->deleteJson("/api/v1/users/{$another->id}")->assertForbidden();
    }

    /**
     * Test if destroy user removes it from database.
     */
    public function test_if_destroy_method_removes_data_from_database() {
        $this->deleteJson("/api/v1/users/{$this->user->id}");

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
        ]);
    }
}
