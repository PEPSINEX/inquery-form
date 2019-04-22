<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Inquiry;

class InquiryTest extends TestCase
{
    /**
     * @test
     */
    public function viewの条件分岐テスト。未対応、対応中、対応済みの3パターンについて()
    {
        $inquiry = factory(Inquiry::class)->create([
            'status' => '00',
        ]);
        $this->assertEquals('未対応', $inquiry->status());

        $inquiry = factory(Inquiry::class)->create([
            'status' => '10',
        ]);
        $this->assertEquals('対応中', $inquiry->status());

        $inquiry = factory(Inquiry::class)->create([
            'status' => '20',
        ]);
        $this->assertEquals('対応済', $inquiry->status());
    }
}
