<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Product;
use App\Models\Price;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use App\Services\User\UserService;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $isCanCreateProduct = (new UserService())->isCanCreateProduct();
        $products = (new ProductService())->getUserProductsPaginate();

        return view('pages.profile.products.index', compact('products', 'isCanCreateProduct'))->with('i',
            (request()->input('page', 1) - 1) * 20);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $isCanCreateProduct = (new UserService())->isCanCreateProduct();

        if ($isCanCreateProduct) {
            $data = (new ProductService())->parseUrlGetParams();
            if ($data) {

                return view('pages.profile.products.create', compact('data'));
            } else {

                return view('pages.profile.products.create');
            }

        } else {
            return back()->with('error', 'Your account does not allow you to create more products. Hang up your account.');
        }


    }

    /**
     * @param ProductStoreRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request, User $user)
    {
        $isCanCreateProduct = (new UserService())->isCanCreateProduct();

        if ($isCanCreateProduct) {
            (new ProductService())->save($request, $user);

            return redirect()->route('profile.products.index')->with('success', 'Product created successfully.');
        } else {

            return redirect()->route('profile.products.index')->with('error', 'Your account does not allow you to create more products. Hang up your account.');
        }
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        $isFollow = (new ProductService())->isFollow($product);

        return view('pages.profile.products.show', compact('product', 'isFollow'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
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
