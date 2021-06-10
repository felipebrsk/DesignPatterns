<?php

namespace Tests\Feature\Http\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\FakerUser;

class IndexUserTest extends TestCase
{
    use RefreshDatabase, FakerUser;
    /**
     * Test if index method can users with 200.
     *
     * @return void
     */
    public function test_if_method_can_show_users()
    {
        $this->getJson('api/v1/users')->assertOk();
    }

    /**
     * Test if index users responds with all users.
     */
    public function test_if_method_can_show_all_users()
    {
        $this->createFakerUsers(10);

        $this->getJson('/api/v1/users')->assertJsonCount(10, 'data');
    }

    /**
     * Test if users index responds with a valid structure.
     */
    public function test_if_users_index_responds_with_a_valid_structure()
    {
        $this->createFakerUsers(10);

        $this->getJson('/api/v1/users')->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'CPF',
                    'email',
                    'birthday',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }
}
