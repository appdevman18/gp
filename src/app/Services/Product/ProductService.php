<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Dto\ProductData;
use App\Models\Price;
use App\Models\User;
use App\Services\Price\PriceService;


final class ProductService
{
    /**
     * @param Request $request
     * @param User $user
     * @return Product
     */
    public function save(Request $request, User $user): Product
    {
        $productData = ProductData::fromRequest($request);

        $product = new Product();
        $product->url = $productData->url;
        $product->title = $productData->title;
        $product->store = $productData->store;
        $product->save();

        if (!$product->save()) {
            // throw new Illuminate\Database\QueryException('dont create or update product.');
        }

        auth()->user()->products()->attach($product->id);

        (new PriceService())->save($request, $product->id);

        return $product;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function destroy(Product $product)
    {
        $prices = (new PriceService())->getPricesByProduct($product);

        foreach ($prices as $price) {
            $price->delete();
        }

        auth()->user()->products()->detach($product->id);
        $product->delete();

        return true;
    }

    /**
     * @return mixed
     */
    public function getUserProductsPaginate()
    {
        return auth()->user()->products()->orderBy('created_at', 'desc')->simplePaginate(20);
    }

    /**
     * @return mixed
     */
    public function getAllStores()
    {
        return Product::pluck('store')->toArray();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllProductsPaginate()
    {
        return Product::with('prices')->orderBy('created_at', 'desc')->simplePaginate(20);
    }

    /**
     * @param $product
     * @return $this
     */
    public function follow($product)
    {
        $product->users()->attach(auth()->user()->id);

        return $this;
    }

    /**
     * @param $product
     * @return $this
     */
    public function unFollow($product)
    {
        $product->users()->detach(auth()->user()->id);

        return $this;
    }

    /**
     * @param $product
     * @return mixed
     */
    public function isFollow($product)
    {
        return $product->users()->where('user_id', auth()->user()->id)->first(['id']);
    }

    /**
     * @return string|string[]
     */
    public function parseUrlGetParams()
    {
        $keys = ['title', 'price', 'store', 'url'];

        $value = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));

        if ($value) {
            $values = explode('&', $value);
            $data = array_combine($keys, $values);

            return $data;
        }

        return '';

    }

    /**
     * @param $productId
     * @return Product
     */
    public function getProductById($productId): Product
    {
        return Product::findOrFail($productId);
    }

}
