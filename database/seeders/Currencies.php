<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Currencies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $currencies;
    protected $currencyTypes;

    public function __construct()
    {
        $this->currencyTypes = config('constants.CURRENCY_TYPES');
        $this->currencies    = config('constants.CURRENCIES');
    }

    public function run()
    {
        // Create  Currencies
        foreach ($this->currencies as $key => $val) {
            ($key == 'PKR') ? $type = $this->currencyTypes['1'] : (($key == 'USD') ? $type = $this->currencyTypes['2'] : $type = $this->currencyTypes['3']);
            Currency::create([
                'code' => strtoupper($key),
                'name' => ucwords($val),
                'type' => $type,
                'created_by' => 'Default'
            ]);
        }
    }
}
