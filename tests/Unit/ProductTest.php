<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{    
    /**
     * Productクラスのメソッドテスト
     */

    /**
     * @test
     */
    public function 引数が一つの場合。配列の個数と製品種別の文字数は初期値()
    {
        $products = Product::getTypes('A');
        $this->assertEquals(16, count($products));
        $this->assertEquals(4, mb_strlen($products[0]));
    }

    /**
     * @test
     */
    public function 引数が二つの場合、配列の個数は2番目の引数、文字数は初期値()
    {
        $products = Product::getTypes('B', 10);
        $this->assertEquals(10, count($products));
        $this->assertEquals(4, mb_strlen($products[0]));
    }

    /**
     * @test
     */
    public function 引数が三つの場合、配列の個数と文字数は対応する引数と等しい()
    {
        $products = Product::getTypes('C', 5, 2);
        $this->assertEquals(5, count($products));
        $this->assertEquals(3, mb_strlen($products[0]));
    }
}
