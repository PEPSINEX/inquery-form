<?php

use Illuminate\Support\Str; // リファレンスに記載されているのでとりあえず追加
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // リファレンスに記載されているのでとりあえず追加

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
        DB::table('staffs')->insert([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
        DB::table('staffs')->insert([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
        DB::table('staffs')->insert([
            'name' => 'test3',
            'email' => 'test3@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
    }
}
