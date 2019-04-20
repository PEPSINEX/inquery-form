<?php

use Illuminate\Support\Str; // リファレンスに記載されているのでとりあえず追加
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // リファレンスに記載されているのでとりあえず追加

class InquiriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->insert([
            'name' => 'inquiries-test',
            'email' => 'inquiries-test1@test.com',
            'phone_number'  => '00000000001',
            'product_type' => 'A001',
            'content' => 'inquiries-test-content1',
        ]);
        DB::table('inquiries')->insert([
            'name' => 'inquiries-test',
            'email' => 'inquiries-test2@test.com',
            'phone_number'  => '00000000002',
            'product_type' => 'A002',
            'content' => 'inquiries-test-content2',
        ]);
        DB::table('inquiries')->insert([
            'name' => 'inquiries-test',
            'email' => 'inquiries-test3@test.com',
            'phone_number'  => '00000000003',
            'product_type' => 'A003',
            'content' => 'inquiries-test-content3',
        ]);
    }
}
