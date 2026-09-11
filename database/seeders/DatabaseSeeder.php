<?php

namespace Database\Seeders;

use App\Models\StyleOfHome;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$this->call([PropertyTypeSeeder::class, AccessibilityFeatureSeeder::class, StyleOfHomeSeeder::class]);
        $this->call([AccessibilityFeatureSeeder::class]);
//         User::factory(10)->create();
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
