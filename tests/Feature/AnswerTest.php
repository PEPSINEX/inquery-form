<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function answers_createにGETメソッドでアクセスできる()
    {
        $response = $this->get('/answers/create');
        $response->assertStatus(200);
    }
}
