<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Product\Follow;


class FollowController extends Controller
{

    public function followProduct(Request $request, Product $product)
    {
        $product = $product::findOrFail($request['product_id']);

        if ('follow' == $request['follow']) {

            $product->follow();

            return redirect()->route('products.index')->with('follow', 'You follow successfully.');

        } else {

            $product->unFollow();

            return redirect()->route('products.index')->with('unFollow', 'You unfollow successfully.');
        }

    }    

}
