<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;


class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function auth_loginにGETメソッドでアクセス出来る()
    {
        $response = $this->get('/auth/login');
        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function auth_loginにログインユーザーPOSTメソッドでアクセス出来る()
    {
        \App\User::create([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
            ]);

        $params = [
            'email'     => 'test1@test.com',
            'password'  => 'password'
        ];
        
        $response = $this->postJson('/auth/login', $params);
        $response->assertRedirect('/home');
    }
    /**
     * @test
     */
    public function auth_loginにinvalidなデータを送信した場合、カラムのそれぞれにエラーメッセージが返却される()
    {
        \App\User::create([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
            ]);

        $params = [
            'email'     => '',
            'password'  => ''
        ];
        
        $response = $this->postJson('/auth/login', $params);
        $response->assertJsonValidationErrors('email', 'password');
    }

    /**
     * @test
     */
    // public function auth_logoutにDELETEメソッドでアクセス出来る()
    // {
    //     $response = $this->delete('/auth/logout');
    //     $response->assertStatus(200);
    // }
    /**
     * @test
     */
    public function homeにGETメソッドでアクセス出来る()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }
}
