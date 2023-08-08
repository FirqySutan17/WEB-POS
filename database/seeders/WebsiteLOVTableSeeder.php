<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WebsiteLOVTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_lov')->insert([
            'key' => 'favicon',
            'name' => 'Favicon',
            'value' => '',
            'type' => 'upload',
            'variant' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'header_logo',
            'name' => 'Header Logo',
            'value' => '',
            'type' => 'upload',
            'variant' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'footer_logo',
            'name' => 'Footer Logo',
            'value' => '',
            'type' => 'upload',
            'variant' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'copyright',
            'name' => 'Copyright',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'introduction',
            'name' => 'Introduction',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'introduction_short',
            'name' => 'Introduction (Short)',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'vision',
            'name' => 'Vision',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'mission',
            'name' => 'Mission',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'email_1',
            'name' => 'Email',
            'value' => '',
            'type' => 'email',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'email_2',
            'name' => 'Email (optional)',
            'value' => '',
            'type' => 'email',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'phone_1',
            'name' => 'Phone',
            'value' => '',
            'type' => 'number',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'phone_2',
            'name' => 'Phone (optional)',
            'value' => '',
            'type' => 'number',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'fax',
            'name' => 'Fax',
            'value' => '',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'whatsapp',
            'name' => 'Whatsapp',
            'value' => '',
            'type' => 'number',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'address',
            'name' => 'Address',
            'value' => '',
            'type' => 'textarea',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'google_map',
            'name' => 'Google Map',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'facebook',
            'name' => 'Facebook',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'twitter',
            'name' => 'Twitter',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'instagram',
            'name' => 'Instagram',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'tiktok',
            'name' => 'Tiktok',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'youtube',
            'name' => 'Youtube',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('website_lov')->insert([
            'key' => 'linkedin',
            'name' => 'Linked In',
            'value' => '',
            'type' => 'text',
            'variant' => 'character',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
