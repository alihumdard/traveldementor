<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    protected $countries;

    public function __construct()
    {
        $this->countries = config('constants.COUNTRIES');
    }
    public function run()
    {
        // Country::truncate();
        foreach ($this->countries as $country) {
            Country::create([
                'name' => $country,
            ]);
        }
    }
}
