<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;

class PosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('status', 1)->latest()->get();
        $brands     = Brand::where('status', 1)->latest()->get();
        $products   = Product::where('status', 1)->latest()->get();
        $customers   = Customer::where('status', 1)->latest()->get();
        return view('pos.pos', compact('categories', 'brands', 'products', 'customers'));
    }
}
