<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            NamesSeeder::class,
            SurnamesSeeder::class,
            PhonesSeeder::class,
            EmailsSeeder::class,
            ImagesSeeder::class,
            UrlsSeeder::class,
        ]);
    }
}
