<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
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
        $customers = Customer::latest()->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'name'      => 'required',
            'city'      => 'required',
            'village'   => 'required',
            'phone'     => 'required',
        ]);

        $customer = new Customer;
        $customer->name       = ucwords($request->name);
        $customer->city       = ucwords($request->city);
        $customer->village    = ucwords($request->village);
        $customer->phone      = $request->phone;
        $customer->created_at = Carbon::now();
        $customer->save();

        Toastr::success('Customer added successfully!');
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
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
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
            'name'      => 'required',
            'city'      => 'required',
            'village'   => 'required',
            'phone'     => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name       = ucwords($request->name);
        $customer->city       = ucwords($request->city);
        $customer->village    = ucwords($request->village);
        $customer->phone      = $request->phone;
        $customer->updated_at = Carbon::now();
        $customer->update();

        Toastr::success('Customer update successfully!');
        return redirect()->route('customer.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        Toastr::error('Customer delete successfully!');
        return back();
    }


    //============== customer active =========

    public function Active($id)
    {
        Customer::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Customer Active successfully!');
        return back();
    }

    //============== customer inactive =========

    public function Inactive($id)
    {
        Customer::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Customer Inactive successfully!');
        return back();
    }
}
