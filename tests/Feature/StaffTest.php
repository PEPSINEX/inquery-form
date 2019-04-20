<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function staffsにGETメソッドでアクセス出来る()
    {
        $response = $this->get('/staffs');
        $response->assertStatus(200);
    }

    // public function staffsにGETメソッドでアクセス出来る()
    // {
    //     $number = 10;
    //     factory(\App\User::class, $number)->create();

    //     $response = $this->get('/staffs');
    //     $response->assertCount($staffs, );
    // }
}
