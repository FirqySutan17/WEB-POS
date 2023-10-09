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
            'email' => 'admin@rimba.com',
            'email_verified_at' => now(),
            'password' => Hash::make('init1234'),
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
