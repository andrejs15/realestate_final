<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        PropertyType::create(['name' => 'House']);
        PropertyType::create(['name' => 'Apartment']);
        PropertyType::create(['name' => 'Room']);
        PropertyType::create(['name' => 'Townhouse']);
        PropertyType::create(['name' => 'Parking']);
    }
}
