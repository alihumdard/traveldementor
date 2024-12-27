<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Users::class);
        $this->call(Currencies::class);
        $this->call(Locations::class);
        $this->call(CategorySeeder::class);
        $this->call(VFSEmbassySeeder::class);
        $this->call(CountrySeeder::class);
    }
}
