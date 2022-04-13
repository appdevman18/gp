<?php

namespace App\Services;



abstract class BaseService
{
    public function __construct() {}

    public function getById(Product $product)
    {
        return Price::where('product_id', $product->id)->get();
    }
}
