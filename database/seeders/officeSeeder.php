<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class officeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $office= [
            [
                'user_id'=>1,
                'location'=>'FL,Florida',
                'status'=>'Main'
            ],
            [
                'user_id'=>2,
                'location'=>'Ochi Rios,JA',
                'status'=>'Local'
            ]
        ];
        foreach ($office as $key => $value) {
            # code...
            Office::create($value);
        }
    }
}
