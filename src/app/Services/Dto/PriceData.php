<?php

namespace App\Services\Dto;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Models\Product;

final class PriceData extends DataTransferObject
{
	public string $value;
	public string $product_id;

    /**
     * @param Request $request
     * @param $product
     * @return static
     */
	public static function fromRequest(Request $request, $product): self
	{
		$request = $request->validated();

        return new self([
            'value' => $request['price'],
            'product_id' => $product,
        ]);
    }

    /**
     * @param Price $price
     * @return static
     */
   	public static function fromModel(Price $price) : self
   	{
   		return new static([
   			'value' => $price->value,
   			'product_id' => $price->product_id,
   		]);
   	}
}
