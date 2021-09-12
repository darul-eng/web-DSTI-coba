<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\People;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        People::factory(20)->create();
        $this->call(UserSeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
