<?php

namespace Database\Seeders;

use App\Models\StyleOfHome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StyleOfHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StyleOfHome::create(['name' => 'A-Frame']);
        StyleOfHome::create(['name' => 'Bungalow']);
        StyleOfHome::create(['name' => 'Cottage']);
        StyleOfHome::create(['name' => 'Dome']);
        StyleOfHome::create(['name' => 'Spanish']);
    }
}
