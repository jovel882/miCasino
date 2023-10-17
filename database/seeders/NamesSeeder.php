<?php

namespace Database\Seeders;

use App\Models\Name;
use Illuminate\Database\Seeder;

class NamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Name::factory()->count(20)->create();
    }
}
