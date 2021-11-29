<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::create([
            'name'=>'Kevorn Callum',
            'email'=>'kevorn.callum16@gmail.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('Kevorn123'),
        ]);
        User::create([
            'name'=>'Manager Callum',
            'email'=>'callum16@gmail.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('Manager123'),
        ]);
    }
}
