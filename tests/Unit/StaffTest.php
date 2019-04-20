<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class StaffTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function getStaffが管理者以外のスタッフを取得する()
    {
        factory(\App\User::class, 9)->create();
        factory(\App\User::class, 1)->create([
            'is_admin' => true
        ]);

        $result = User::getStaff();
        foreach($result as $key => $value)
        {
            $this->assertNotEquals($value->is_admin, true);
        }
    }
}
