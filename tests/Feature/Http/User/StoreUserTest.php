<?php

namespace Tests\Feature\Http\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Get faker user.
     *
     * @return string[]
     */
    protected function getFakerUser(): array {
        return [
            'name' => 'Faker User',
            'email' => 'fakeruser@gmail.com',
            'CPF' => '000.000.000-00',
            'birthday' => '1980-01-01',
            'password' => 'admin1234',
        ];
    }

    /**
     * Test if store user responds with 201 status code.
     */
    public function test_if_store_method_can_assert_with_created() {
        $this->postJson('/api/v1/users', $this->getFakerUser())->assertCreated();
    }

    /**
     * Test if store user creates an user with correctly attributes.
     */
    public function test_if_store_method_can_assert_data_with_correctly_attributes() {
        $user = $this->getFakerUser();

        $this->postJson('/api/v1/users', $user);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'email' => $user['email'],
            'CPF' => $user['CPF'],
            'birthday' => $user['birthday'],
        ]);
    }
}
