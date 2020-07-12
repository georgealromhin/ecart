<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'id' => 1,
        //     'name' => 'root',
        //     'username' => 'root',
        //     'password' => bcrypt('root'),
        //     'role' => 'main',
        // ]);

        DB::table('settings')->insert([
            'id' => 1,
            'name' => 'store_name',
            'value' => 'My Store',
        ]);

        DB::table('settings')->insert([
            'id' => 2,
            'name' => 'address',
            'value' => 'Country - City 4900022',
        ]);

        DB::table('settings')->insert([
            'id' => 3,
            'name' => 'email',
            'value' => 'example@domain.com',
        ]);

        DB::table('settings')->insert([
            'id' => 4,
            'name' => 'phone',
            'value' => '123456789',
        ]);

        DB::table('settings')->insert([
            'id' => 5,
            'name' => 'facebook_link',
            'value' => 'https://www.facebook.com/',
        ]);

        DB::table('settings')->insert([
            'id' => 6,
            'name' => 'instagram_link',
            'value' => 'https://www.instagram.com/',
        ]);

        DB::table('settings')->insert([
            'id' => 7,
            'name' => 'twitter_link',
            'value' => 'https://twitter.com/',
        ]);

        DB::table('settings')->insert([
            'id' => 8,
            'name' => 'youtube_link',
            'value' => 'https://youtube.com/',
        ]);

        DB::table('settings')->insert([
            'id' => 9,
            'name' => 'vk_link',
            'value' => 'https://vk.com/',
        ]);

        DB::table('settings')->insert([
            'id' => 10,
            'name' => 'telegram_username',
            'value' => 'username',
        ]);

        DB::table('settings')->insert([
            'id' => 11,
            'name' => 'whatsapp_number',
            'value' => '123456789',
        ]);

        DB::table('settings')->insert([
            'id' => 12,
            'name' => 'opening_hours',
            'value' => 'text',
        ]);

        DB::table('settings')->insert([
            'id' => 13,
            'name' => 'meta_title',
            'value' => 'Meta title',
        ]);

        DB::table('settings')->insert([
            'id' => 14,
            'name' => 'meta_tag',
            'value' => 'Meta Tag Description',
        ]);

        DB::table('settings')->insert([
            'id' => 15,
            'name' => 'header_image',
            'value' => 'images/header_image.webp',
        ]);

        DB::table('settings')->insert([
            'id' => 16,
            'name' => 'about',
            'value' => 'About us text',
        ]);

        DB::table('settings')->insert([
            'id' => 17,
            'name' => 'delivery_information',
            'value' => 'Delivery information text',
        ]);

        DB::table('settings')->insert([
            'id' => 18,
            'name' => 'privacy_policy',
            'value' => 'Privacy Policy text',
        ]);

        DB::table('settings')->insert([
            'id' => 19,
            'name' => 'terms_conditions',
            'value' => 'Terms & Conditions text',
        ]);

        DB::table('settings')->insert([
            'id' => 20,
            'name' => 'footer_text',
            'value' => 'Footer text',
        ]);
    }
}
