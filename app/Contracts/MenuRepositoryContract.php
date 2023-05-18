<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface MenuRepositoryContract
{
    public function index(int $userId): Collection;

    public function find(string $slug): Model;

    public function store(array $data): Model;

    public function update(int $id, array $data): void;

    public function destroy(int $id): void;
}
