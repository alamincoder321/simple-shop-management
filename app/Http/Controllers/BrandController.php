<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Brand;
use Carbon\Carbon;

class BrandController extends Controller
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
        $brands = Brand::latest()->get();
        return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
            'name'      => 'required|unique:brands',
        ]);

        $brand = new Brand;
        $brand->name       = ucwords($request->name);
        $brand->created_at = Carbon::now();
        $brand->save();

        Toastr::success('Brand added successfully!');
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
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
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
            'name'      => 'required|unique:brands',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name       = ucwords($request->name);
        $brand->updated_at = Carbon::now();
        $brand->update();

        Toastr::success('Brand update successfully!');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        Toastr::error('Brand delete successfully!');
        return back();
    }


    //============== brand active =========

    public function Active($id)
    {
        Brand::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Brand Active successfully!');
        return back();
    }

    //============== brand inactive =========

    public function Inactive($id)
    {
        Brand::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Brand Inactive successfully!');
        return back();
    }
}
