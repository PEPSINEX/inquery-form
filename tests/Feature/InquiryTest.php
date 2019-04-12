<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Inquiry;
use App\Mail\Inquired;
use Mail;
use Illuminate\Support\Facades\Auth;    // 認証機能のため追加

class InquiryTest extends TestCase
{
    use RefreshDatabase;
    
    /**
    * @test
    */
    public function 非ログイン時はcreateにGETメソッドでアクセスできる()
    {
        $response = $this->get('inquiries/create');
        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function ログイン時はcreateにGETメソッドでアクセスできない()
    {
        $staff = factory(\App\User::class)->create();
        Auth::login($staff);
        
        $response = $this->get('inquiries/create');
        $response->assertStatus(403);
    }

    /**
    * @test
    */
    public function 非ログイン時はstoreにPOSTメソッドでアクセスできる()
    {   
        $response = $this->post('inquiries');
        $response->assertStatus(302);
    }

    /**
    * @test
    */
    public function ログイン時はstoreにPOSTメソッドでアクセスできない()
    {
        $staff = factory(\App\User::class)->create();
        Auth::login($staff);
        
        $response = $this->post('inquiries');
        $response->assertStatus(403);
    }

    /**
    * @test
    */
    public function ログイン時はshowにGETメソッドでアクセスできる()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create();
        Auth::login($staff);
        
        $response = $this->get("inquiries/{$inquiry->id}");
        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function 非ログイン時はshowにGETメソッドでアクセスできない()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create();
        
        $response = $this->get("inquiries/{$inquiry->id}");
        $response->assertStatus(403);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいない場合、ログイン時はupdateにPOSTメソッドでアクセスできる()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create([
            'status'  => '00',
        ]);
        Auth::login($staff);
        
        $response = $this->patch("inquiries/{$inquiry->id}");
        $response->assertStatus(302);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいない場合、非ログイン時はupdateにPOSTメソッドでアクセスできない()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create([
            'status'  => '00',
        ]);
        
        $response = $this->patch("inquiries/{$inquiry->id}");
        $response->assertStatus(403);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいる場合、対応スタッフはupdateにPOSTメソッドでアクセスできる()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create([
            'status'    => '10',
            'staff_id'  => $staff->id,
        ]);
        Auth::login($staff);
        
        $response = $this->patch("inquiries/{$inquiry->id}");
        $response->assertStatus(302);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいる場合、非対応スタッフはupdateにPOSTメソッドでアクセスできない()
    {
        $reply_staff = factory(\App\User::class)->create([
            'id'    => 1,
        ]);

        $not_reply_staff = factory(\App\User::class)->create([
            'id'    => 2,
        ]);

        $inquiry = factory(\App\Inquiry::class)->create([
            'status'    => '10',
            'staff_id'  => 1,
        ]);
        Auth::login($not_reply_staff);
        
        $response = $this->patch("inquiries/{$inquiry->id}");
        $response->assertStatus(403);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいる場合、対応スタッフはreplyにPATCHメソッドでアクセスできる()
    {
        $staff = factory(\App\User::class)->create();
        $inquiry = factory(\App\Inquiry::class)->create([
            'status'    => '10',
            'staff_id'  => $staff->id,
        ]);
        Auth::login($staff);

        $response = $this->patch("inquiries/{$inquiry->id}/reply");
        $response->assertStatus(302);
    }

    /**
    * @test
    */
    public function 対応中スタッフがいる場合、非対応スタッフはreplyにPATCHメソッドでアクセスできない()
    {
        $reply_staff = factory(\App\User::class)->create([
            'id'    => 1,
        ]);

        $not_reply_staff = factory(\App\User::class)->create([
            'id'    => 2,
        ]);

        $inquiry = factory(\App\Inquiry::class)->create([
            'status'    => '10',
            'staff_id'  => 1,
        ]);
        Auth::login($not_reply_staff);
        
        $response = $this->patch("inquiries/{$inquiry->id}/reply");
        $response->assertStatus(403);
    }

    // /**
    // * @test
    // */
    // public function 対応スタッフはeditにGETメソッドでアクセスできる()
    // {
    //     $staff = factory(\App\User::class)->create();
    //     $inquiry = factory(\App\Inquiry::class)->create([
    //         'staff_id'  =>  $staff->id,
    //     ]);
    //     Auth::login($staff);
        
    //     $response = $this->post("inquiries/${$staff->id}");
    //     $response->assertStatus(403);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiries_createにGETメソッドでアクセス出来る()
    // {
    //     # お問い合わせページへのアクセス
    //     $response = $this->get('/inquiries/create');
    //     $response->assertStatus(200);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにPOSTメソッドでアクセス出来る()
    // {
    //     $inquiry = [
    //         'name'          => 'test100',
    //         'email'         => 'test100@test.com',
    //         'phone_number'  => '00000000100',
    //         'product_type'  => 'A010',
    //         'content'       => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    //     ];
    //     $response = $this->postJson('/inquiries', $inquiry);
    //     $response->assertStatus(200);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにお問い合わせ内容をPOSTするとinquriesテーブルにそのデータが追加される()
    // {
    //     $params = [
    //         'name'          => 'test100',
    //         'email'         => 'test100@test.com',
    //         'phone_number'  => '00000000100',
    //         'product_type'  => 'A010',
    //         'content'       => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    //     ];
    //     $this->postJson('/inquiries', $params);
    //     $this->assertDatabaseHas('inquiries', $params);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにお問い合わせ内容をPOSTすると、確認の文言が表示される()
    // {
    //     $params = [
    //         'name'          => 'test100',
    //         'email'         => 'test100@test.com',
    //         'phone_number'  => '00000000100',
    //         'product_type'  => 'A010',
    //         'content' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    //     ];
    //     $response = $this->postJson('/inquiries', $params);
    //     $response->assertSeeText('お問い合わせを承りました。');
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにinvalidなデータを送信した場合、422UnprocessableEntityが返却される()
    // {
    //     $params = [
    //         'name'          => '12345678901234567',
    //         'email'         => 'not_email_format',
    //         'phone_number'  => '1234567890123',
    //         'product_type'  => 'A100',
    //         'content' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    //     ];
    //     $response = $this->postJson('/inquiries', $params);
    //     $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにinvalidなデータを送信した場合、カラムのそれぞれにエラーメッセージが返却される()
    // {
    //     $too_long_name          = str_repeat('a', 17);
    //     $too_long_phone_number  = str_repeat(0, 17);
    //     $too_long_content       = str_repeat('a', 2001);

    //     $params = [
    //         'name'          => $too_long_name,
    //         'email'         => 'not_email_format',
    //         'phone_number'  => $too_long_phone_number,
    //         'product_type'  => 'A100',
    //         'content'       => $too_long_content
    //     ];
    //     $response = $this->postJson('/inquiries', $params);
    //     $response->assertJsonValidationErrors('name', 'email', 'phone_number', 'product_type', 'content');
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにお問い合わせ内容をPOSTすると、メールが送信される()
    // {
    //     Mail::fake();

    //     $params = [
    //         'name'          => 'test100',
    //         'email'         => 'test100@test.com',
    //         'phone_number'  => '00000000100',
    //         'product_type'  => 'A010',
    //         'content'       => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    //     ];
    //     $response = $this->postJson('/inquiries', $params);
    //     Mail::assertSent(Inquired::class, 1);
    // }

    // /**
    //  * @test
    //  */
    // public function inquiriesにGETメソッドでアクセス出来る()
    // {
    //     $response = $this->get('/inquiries');
    //     $response->assertStatus(200);
    // }
}
