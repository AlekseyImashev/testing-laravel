<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Product name.
     *
     * @var string
     */
    protected $name;

    /**
     * Product value.
     *
     * @var int
     */
    protected $cost;

    /**
     * Create a new Product instance.
     *
     * @param string $name.
     * @param int $cost
     */
    public function __construct($name, $cost)
    {
        $this->name = $name;

        $this->cost = $cost;
    }

    /**
     * Name of product.
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Cost of product.
     */
    public function cost()
    {
        return $this->cost;
    }
}
