<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::create([
            'name' => 'Program S1',
            'slug' => 'program-s1',
        ]);
        Category::create([
            'name' => 'Program S2',
            'slug' => 'program-s2',
        ]);
        Category::create([
            'name' => 'Program Magister',
            'slug' => 'program-magister',
        ]);
    }
}
