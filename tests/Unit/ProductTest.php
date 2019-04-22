<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{
    // use RefreshDatabase;
    
    /**
     * @test
     */
    public function 製品種別の個数が設定した値と等しい()
    {
        $this->assertCount(Product::NUMBER_OF_TYPES, Product::getTypes());
    }

    /**
     * @test
     */
    public function 配列に含まれる一番最初の製品が_A001()
    {
        $product_types = Product::getTypes();
        $this->assertEquals('A001', $product_types[0]);
    }

    /**
     * @test
     */
    public function 配列に含まれる一番最後のの製品が_A016()
    {
        $product_types = Product::getTypes();
        $this->assertEquals('A016', end($product_types));
    }
}
