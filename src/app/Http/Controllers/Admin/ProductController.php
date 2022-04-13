<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Product;
use App\Models\Price;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = $this->productService->getAllProductsPaginate();

        return view('pages.admin.products.index', compact('products'))->with('i',
            (request()->input('page', 1) - 1) * 20);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data = $this->productService->parseUrlGetParams();

        if ($data) {
            return view('pages.admin.products.create', compact('data'));
        }

        return view('pages.admin.products.create');
    }

    /**
     * @param ProductStoreRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request, User $user)
    {
        $this->productService->save($request, $user);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        $isFollow = $this->productService->isFollow($product);

        return view('pages.admin.products.show', compact('product', 'isFollow'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        if (Gate::allows('user-delete')) {
            $this->productService->destroy($product);

            return redirect()->route('products.index')->with('success', 'Product deleted.');
        } else {

            return back()->with('error', 'You do not have permission to delete');
        }

    }
}
