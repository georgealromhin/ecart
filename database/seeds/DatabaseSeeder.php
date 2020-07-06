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

        DB::table('categories')->insert([
            'name' => 'category33',
            'status' => 'visible',
        ]);
    }
}
