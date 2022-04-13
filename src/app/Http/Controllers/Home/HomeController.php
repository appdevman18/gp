<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Product\ProductService;


class HomeController extends Controller
{
    public function index()
    {
        $stores = (new ProductService())->getAllStores();
        $stores = array_unique($stores, SORT_STRING);

        return view('pages.home.index', compact('stores'));
    }

    public function help()
    {
        return view('pages.home.help');
    }

    public function price()
    {
        return view('pages.home.price');
    }
}
