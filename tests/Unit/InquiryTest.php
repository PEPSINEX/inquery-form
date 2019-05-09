<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Inquiry;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function mbSubstrContentメソッドテスト。文字数が101文字以上の場合、100文字まで表示()
    {
        $rand_number = rand(101, 2000);
        $tmp_content = str_repeat('あ', $rand_number);

        $inquiry = factory(Inquiry::class)->create([
            'content' => $tmp_content,
        ]);
        
        $content = $inquiry->mbSubstrContent(100);
        $this->assertEquals(103, mb_strlen($content));
    }

    /**
     * @test
     */
    public function mbSubstrContentメソッドテスト。文字数が100文字以下の場合、そのまま表示()
    {
        $inquiry = factory(Inquiry::class)->create([
            'content' => 'test-content'
        ]);
        $content = $inquiry->mbSubstrContent(100);
        $this->assertEquals('test-content', $content);
    }
}
