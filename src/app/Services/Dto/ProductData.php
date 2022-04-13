<?php

namespace App\Services\Dto;

use App\Models\Product;
use Illuminate\Http\Request;

final class ProductData extends DataTransferObject
{
	public string $url;
	public string $title;
	public string $store;

    /**
     * @param Request $request
     * @return static
     */
	public static function fromRequest(Request $request): self
	{
		$request = $request->validated();

        return new self([
            'url' => $request['url'],
            'title' => $request['title'],
            'store' => $request['store'],
        ]);
    }

    /**
     * @param Product $product
     * @return static
     */
   	public static function fromModel(Product $product) : self
   	{
   		return new static([
   			'url' => $product->id,
   			'title' => $product->name,
   			'store' => $product->store,
   		]);
   	}
}
