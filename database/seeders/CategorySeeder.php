<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     protected $categories;
     protected $status;

    public function __construct()
    {
        $this->categories = config('constants.CATEGORIES');
        $this->status = config('constants.USER_STATUS');
    }
    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category['name'],
                'type' => $category['type'],
                'status' => $this->status['Active'],
            ]);
        }
    }
}
