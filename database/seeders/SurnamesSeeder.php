<?php

namespace Database\Seeders;

use App\Models\Surname;
use Illuminate\Database\Seeder;

class SurnamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Surname::factory()->count(20)->create();
    }
}
