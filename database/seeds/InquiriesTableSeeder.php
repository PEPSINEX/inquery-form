<?php

use Illuminate\Database\Seeder;

class InquiriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Inquiry::class, 2)->create([
            'status' => '00',
        ]);
        factory(App\Inquiry::class, 2)->create([
            'status' => '10',
        ]);
        factory(App\Inquiry::class, 2)->create([
            'status' => '20',
        ]);
    }
}
