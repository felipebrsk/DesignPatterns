<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function store(array $data): Model;
    public function show(int $id): Model;
    public function update(array $data, $id);
    public function destroy(int $id);
}