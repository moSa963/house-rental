<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(HouseImageSeeder::class);
        $this->call(HouseRuleSeeder::class);
        $this->call(HouseFeatureSeeder::class);
        $this->call(HouseReviewSeeder::class);
    }
}
