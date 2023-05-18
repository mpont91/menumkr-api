<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public const DEFAULT_NAME = 'Marc Pont';

    public const DEFAULT_EMAIL = 'mpont91@gmail.com';

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        try {
            $user = User::factory()->create(
                [
                    'name' => self::DEFAULT_NAME,
                    'email' => self::DEFAULT_EMAIL,
                ]
            );
        } catch (QueryException $e) {
            $user = User::query()->where('email', self::DEFAULT_EMAIL)->first();
        }

        $this->callWith(MenuSeeder::class, ['user_id' => $user->id]);
    }
}
