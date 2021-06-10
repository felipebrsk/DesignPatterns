<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Collection;

trait FakerUser {
    /**
     * Create faker user.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function createFakerUser(array $data = []): User {
        return User::factory()->create($data);
    }

    /**
     * Create faker user.
     *
     * @param int $many
     * @return \App\Models\User
     */
    public function createFakerUsers(int $many): Collection {
        return User::factory($many)->create();
    }

    /**
     * Create a faker user and make it current user.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function actingAsFakerUser(array $data = []): User {
        $user = $this->createFakerUser($data);

        $this->actingAs($user);

        return $user;
    }
}