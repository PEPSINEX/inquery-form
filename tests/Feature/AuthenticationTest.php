<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\StaffRegisterd;
use Illuminate\Support\Facades\Notification;    //　通知のテストに必要かも？
use Illuminate\Notifications\AnonymousNotifiable;   //　通知のテストに必要かも？
use Illuminate\Support\Facades\Auth;    // 管理者のスタッフ登録時テストに使用

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function 非ログイン状態だと、auth_registerにGETメソッドでアクセス出来る()
    {
        $this->assertGuest($guard = null);
        $response = $this->get('/auth/register');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function 非管理者の場合、ログイン状態だとauth_registerにGETメソッドでアクセスできず、homeにリダイレクトされる()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);

        $response = $this->get('/auth/register');
        $response->assertRedirect('/home');
    }

    /**
     * @test
     */
    public function 管理者の場合、ログイン状態でもauth_registerにGETメソッドでアクセスできる()
    {
        $admin_user = factory(\App\User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin_user);

        $response = $this->get('/auth/register');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function auth_registerにPOSTメソッドでvalidなデータ送信すると、auth_registerにリダイレクトする()
    {
        $params = [
            'name'  => 'staff2',
            'email' => 'staff2@staff.com'
        ];
        $response = $this->postJson('/auth/register', $params);
        $response->assertRedirect('/auth/register');
    }

    /**
     * @test
     */
    public function 管理者がスタッフ登録をしても、登録したスタッフでログイン状態にならない()
    {
        $admin_user = factory(\App\User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin_user);

        $params = [
            'name'  => 'staff2',
            'email' => 'staff2@staff.com'
        ];
        $response = $this->postJson('/auth/register', $params);

        $login_user = Auth::user();
        $this->assertNotSame($login_user->email, 'staff2@staff.com');
        $this->assertSame($login_user, $admin_user);
    }


    /**
     * @test
     */
    // 通知を使用したメール送信テスト実装できず。
    // public function auth_loginにPOSTメソッドでvalidなformデータを送信すると、メールが送信される()
    // {
    //     Notification::fake();

    //     $params = [
    //         'name'  => 'staff2',
    //         'email' => 'staff2@staff.com'
    //     ];
    //     // "updated_at":"2019-04-15 01:28:41","created_at":"2019-04-15 01:28:41","id":1} 
    //     $response = $this->postJson('/auth/register', $params);
        
    //     Notification::assertSentTo($params, StaffRegisterd::class);
    // }
}