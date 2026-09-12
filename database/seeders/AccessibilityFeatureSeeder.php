<?php

namespace Database\Seeders;

use App\Models\AccessibilityFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessibilityFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessibilityFeature::create(['name' => 'Extra-wide doorways']);
        AccessibilityFeature::create(['name' => 'Ramps']);
        AccessibilityFeature::create(['name' => 'Grab bars']);
        AccessibilityFeature::create(['name' => 'Lower counter heights']);
        AccessibilityFeature::create(['name' => 'Spanish']);

    }
}
