<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The products received in the order.
     *
     * @var array
     */
    protected $products = [];

    /**
     * Adding products to the order.
     *
     * @param \App\Product $product
     */
    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * Number of products in order.
     *
     * @return array
     */
    public function products()
    {
        return $this->products;
    }

    /**
     * Total order counting
     *
     * @return int
     */
    public function total()
    {
        return array_reduce($this->products, function ($carry, $product) {
            return $carry + $product->cost();
        });
    }
}
