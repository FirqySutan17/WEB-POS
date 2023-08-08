<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'employee_id' => '01220023',
            'email' => 'admin@rimba.com',
            'email_verified_at' => now(),
            'phone_number' => '08123456789',
            'office' => 'Rimba House, Cipondoh',
            'password' => Hash::make('rimba1234'),
            'image' => 'placeholder/user-placeholder.png',
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Editor',
        //     'email' => 'editor@cms.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('admin1234'),
        //     'image' => 'placeholder/user-placeholder.png',
        //     'remember_token' => Str::random(10),
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
    }
}
