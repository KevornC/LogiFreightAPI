<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\rate;

class rateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        rate::create([
            'custom_fees'=>'50',
            'rate_per_pound'=>'500'
        ]);
    }
}
