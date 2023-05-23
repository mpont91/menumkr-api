<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'EUR', 'symbol' => '€'],
            ['name' => 'USD', 'symbol' => '$'],
        ];

        foreach ($currencies as $currency) {
            Currency::factory()->create($currency);
        }
    }
}
