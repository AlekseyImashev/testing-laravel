<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp()
    {
        $this->product = new Product('Fallout 4', 59);
    }

    /** @test */
    public function a_product_has_a_name()
    {
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    /** @test */
    public function a_product_has_a_cost()
    {
        $this->assertEquals(59, $this->product->cost());
    }
}
