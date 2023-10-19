<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Seeder;

class UrlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Url::factory()->count(20)->create();
    }
}
