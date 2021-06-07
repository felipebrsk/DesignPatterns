<?php

namespace App\Repositories\Contracts;

use App\Http\Resources\UserResource;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function store(array $data);
}