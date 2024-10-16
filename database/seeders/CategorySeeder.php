<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Web Development',
            'slug' => 'web-develoment',
            'color'=> 'yellow'
        ]);

        Category::factory()->create([
            'name' => 'Mobile Programming',
            'slug' => 'mobile-programming',
            'color'=> 'red'
        ]);

        Category::factory()->create([
            'name' => 'UI UX',
            'slug' => 'ui-ux',
            'color'=> 'green'
        ]);

        Category::factory()->create([
            'name' => 'Cyber Security',
            'slug' => 'cyber-security',
            'color'=> 'blue'
        ]);
    }
}