<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Services\Product\Follow;
use App\Models\Product;
use App\Models\Price;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = (new Product())->getMyProducts();
        // $products = (new Product())->getAllProducts();
        
        return view('pages.profile.products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));

        if ($data) {
            list($title, $price, $store, $url) = explode('&', $data);
            
            return view('pages.profile.products.create', compact('title', 'price', 'store', 'url'));
        }

        return view('pages.profile.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = new Product();
        $product->url = $request['url'];
        $product->title = $request['title'];
        $product->store = $request['store'];
        $product->save();

        if (!$product->save()) {
            return redirect()->back()->with('error', 'Product dont created successfully.');
        }

        $user = User::findOrFail(Auth::id());
        $user->products()->attach($product->id);

        Price::create([
            'value'      => $request['price'],
            'product_id' => $product->id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.profile.products.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Gate::allows('manage-users')) {

            $prices = Price::where('product_id', $product->id)->get();

            foreach ($prices as $price) {
                $price->delete();
            }

            auth()->user()->products()->detach($product->id);

            $product->delete();


            return redirect()->route('products.index')->with('success', 'Product deleted.');

        } else {

            return back()->with('error', 'You do not have permission to delete');
        }
        
    }
}
