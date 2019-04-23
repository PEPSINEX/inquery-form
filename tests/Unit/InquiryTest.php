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
    public function アクセサ定義テスト。statusカラム。未対応、対応中、対応済みの3パターンについて()
    {
        $inquiry = factory(Inquiry::class)->create([
            'status' => '00',
        ]);
        $this->assertEquals('未対応', $inquiry->status);

        $inquiry = factory(Inquiry::class)->create([
            'status' => '10',
        ]);
        $this->assertEquals('対応中', $inquiry->status);

        $inquiry = factory(Inquiry::class)->create([
            'status' => '20',
        ]);
        $this->assertEquals('対応済', $inquiry->status);
    }

    /**
     * @test
     */
    public function scopeSortCreatedAtメソッドテスト。問い合わせ日時の昇順で並べ替え()
    {
        $number = 5;
        factory(Inquiry::class, $number)->create();
        $inquiry = Inquiry::sortCreatedAt('asc')->get();

        for ($i=0; $i < $number-1; $i++)
        {
            $this->assertGreaterThan($inquiry[$i]->created_at, $inquiry[$i+1]->created_at);
        }
    }

    /**
     * @test
     */
    public function mbSubstrメソッドテスト。指定した文字数での切り出し()
    {
        $inquiry = factory(Inquiry::class)->create();
        $inquiry = $inquiry->mbSubstr('content', 100);
        $this->assertEquals(105, mb_strlen($inquiry));
    }

    /**
     * @test
     */
    public function scopeFindByColumnValueメソッドテスト。特定のデータを取得()
    {
        factory(Inquiry::class, 1)->create([
            'status' => '00',
        ]);
        factory(Inquiry::class, 2)->create([
            'status' => '10',
        ]);
        factory(Inquiry::class, 3)->create([
            'status' => '20',
        ]);

        $inquiry = Inquiry::findByColumnValue('status', '10')->get();
        $this->assertCount(2, $inquiry);
    }
}
