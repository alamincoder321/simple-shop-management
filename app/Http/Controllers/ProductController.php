<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;

class ProductController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->latest()->get();
        $brands     = Brand::where('status', 1)->latest()->get();
        return view('product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_id'      => 'required',
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'qty'           => 'required',
            'code'          => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg',
        ]);
        
        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/product/'.$filename));
            $img_url ="images/product/".$filename;
        }

        $product = new Product;
        $product->brand_id      = $request->brand_id;
        $product->category_id   = $request->category_id;
        $product->name          = ucwords($request->name);
        $product->price         = $request->price;
        $product->qty           = $request->qty;
        $product->code          = $request->code;
        $product->image         = $img_url;
        $product->created_at    = Carbon::now();
        $product->save();

        Toastr::success('Product added successfully!');
        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::where('status', 1)->latest()->get();
        $brands     = Brand::where('status', 1)->latest()->get();
        return view('product.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'brand_id'      => 'required',
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'qty'           => 'required',
            'code'          => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg',
        ]);
        
        $product  = Product::findOrFail($id);
        $old      = $product->image;

        if($request->hasFile('image')) {

            if (File::exists($old)) {
                File::delete($old);
            }

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/product/'.$filename));
            $img_url ="images/product/".$filename;
        }

        $product->brand_id      = $request->brand_id;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->qty           = $request->qty;
        $product->code          = $request->code;
        $product->image         = $img_url;
        $product->updated_at    = Carbon::now();
        $product->update();

        Toastr::success('Product update successfully!');
        return redirect()->route('product.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $old     = $product->image;

        if ($product) {
            if (File::exists($old)) {
                File::delete($old);
            }

            $product->delete();
            Toastr::error('Product delete successfully!');
            return back();
        }
    }

    //============== Product active =========

    public function Active($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Product Active successfully!');
        return back();
    }

    //============== Product inactive =========

    public function Inactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Product Inactive successfully!');
        return back();
    }
}
