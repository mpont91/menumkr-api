<?php

namespace App\Repositories;

use App\Contracts\MenuRepositoryContract;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuRepository implements MenuRepositoryContract
{
    public function index(int $userId): Collection
    {
        return Menu::query()->where('user_id', $userId)->get();
    }

    public function find(string $slug): Model
    {
        return Menu::query()
            ->with('headings', 'headings.dishes')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function store(array $data): Model
    {
        $data = array_merge($data, ['slug' => Str::slug($data['name'])]);

        return Menu::query()->create($data);
    }

    public function update($id, $data): void
    {
        Menu::query()->findOrFail($id)->update($data);
    }

    public function destroy($id): void
    {
        Menu::query()->findOrFail($id);
    }
}
