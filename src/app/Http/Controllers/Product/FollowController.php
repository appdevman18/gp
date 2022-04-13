<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Product\Follow;
use App\Services\Product\ProductService;


final class FollowController extends Controller
{
    public function __construct(private ProductService $productService) {}

    public function followProduct(Request $request, Product $product)
    {
        $product = $this->productService->getProductById($request['product_id']);

        if ('follow' == $request['follow']) {
            $this->productService->follow($product);
            if (auth()->user()->hasRole('customer')) {
                return redirect()->route('profile.products.index')->with('follow', 'You follow successfully.');
            }

            return redirect()->route('products.index')->with('follow', 'You follow successfully.');
        } else {
            $this->productService->unFollow($product);
            if (auth()->user()->hasRole('customer')) {
                return redirect()->route('profile.products.index')->with('follow', 'You follow successfully.');
            }

            return redirect()->route('products.index')->with('unFollow', 'You unfollow successfully.');
        }

    }

}
