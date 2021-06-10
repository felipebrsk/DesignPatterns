<?php

namespace Tests\Feature\Http\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\FakerUser;

class UpdateUserTest extends TestCase
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
     * Get faker update data.
     *
     * @return array
     */
    protected function getDataToUpdate(): array
    {
        return [
            'name' => 'Updated Name',
            'email' => 'updatedmail@gmail.com',
            'CPF' => '111.111.111-11',
            'birthday' => '2000-01-01'
        ];
    }

    /**
     *  Test if an user can update profile data.
     */
    public function test_if_an_user_can_update_profile_data()
    {
        $this->patchJson("/api/v1/users/{$this->user->id}")->assertOk();
    }

    /**
     * Test if update user responds with forbidden if try to update another user.
     */
    public function test_if_update_method_responds_with_forbidden_if_try_to_update_another_user() {
        $not_user = $this->createFakerUser();

        $this->patchJson("/api/v1/users/{$not_user->id}")->assertForbidden();
    }

    /**
     *  Test if the return data is correctly updated.
     */
    public function test_if_return_data_is_correctly_updated()
    {
        $update_user = $this->getDataToUpdate();
        
        $this->patchJson("/api/v1/users/{$this->user->id}", $update_user)->assertJson([
            'data' => [
                'name' => $update_user['name'],
                'email' => $update_user['email'],
                'CPF' => $update_user['CPF'],
                'birthday' => $update_user['birthday'],
            ]
        ]);
    }
}
