<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;


class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Create an Super Admins
        User::factory()->create([
            'name'       => 'Super Admin',
            'email'      => 'superadmin@gmail.com',
            'password'   => Hash::make('12345'),
            'role'       => 'Super Admin',
            'status'     => '1',
            'created_by' => '1',
        ]);

        // Create a Staff 
        User::factory()->create([
            'name'         => 'Staff',
            'email'        => 'staff@gmail.com',
            'password'     => Hash::make('12345'),
            'role'         => 'Staff',
            'status'       => '1',
            'sadmin_id'    => '1',
            'created_by'   => '1'
        ]);

        // Create a Client
        User::factory()->create([
            'name'      => 'User',
            'email'     => 'user@gmail.com',
            'password'  => Hash::make('12345'),
            'role'      => 'User',
            'status'    => '1',
            'staff_id'  => '2',
            'sadmin_id' => '1',
            'created_by' => '2'
        ]);
    }
    
    
}
