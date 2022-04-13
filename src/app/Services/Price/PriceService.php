<?php

namespace App\Services\Price;

use App\Models\Product;
use App\Services\Dto\PriceData;
use App\Models\Price;
use Illuminate\Http\Request;

final class PriceService
{
    /**
     * @param Product $product
     * @return mixed
     */
    public function getPricesByProduct(Product $product)
    {
        return Price::where('product_id', $product->id)->get();
    }

    /**
     * @param Request $request
     * @param $product
     * @return Price
     */
    public function save(Request $request, $product): Price
    {
        $priceData = PriceData::fromRequest($request, $product);

        $price = new Price();
        $price->value = $priceData->value;
        $price->product_id = $priceData->product_id;
        $price->save();

        if (!$price->save()) {
            // throw new Illuminate\Database\QueryException('dont create or update price.');
        }

        return $price;
    }
}
