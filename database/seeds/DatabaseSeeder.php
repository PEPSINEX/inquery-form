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
        $this->call(StaffsTableSeeder::class);
        $this->call(InquiriesTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
    }
}
