<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;

class CartController extends Controller
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

    public function index(Request $request)
    {

        Cart::add([
            'id'   => $request->id,
            'name' => $request->name,
            'qty'   => $request->qty,
            'price'   => $request->price,
        ]);

        Toastr::success('Cart added successfully!');
        return back();
    }

    public function update(Request $request, $rowId)
    {
        Cart::update($rowId, ['qty' => $request->qty]);
        Toastr::success('Qty update successfully!');
        return back();
    }


    public function remove($rowId)
    {
        Cart::remove($rowId);
        Toastr::error('Cart remove successfully!');
        return back();
    }



    public function Ivoice(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
        ],[
            'customer_id.required' => 'Selected customer name first',
        ]);
        $customer = Customer::where('id', $request->customer_id)->first();
        $content = Cart::content();
        return view('pos.invoice', compact('customer', 'content'));
    }



    public function FinalInvoice(Request $request)
    {
        $data              = new Order;
        $data->customer_id = $request->customer_id;
        $data->t_qty = $request->t_qty;
        $data->pay_date = $request->pay_date;
        $data->type = $request->type;
        $data->pay = $request->pay;
        $data->save();

        $order_id = $data->id;
        $products = Cart::content(); 
        foreach($products as $product){
            $odetail               = new Orderdetail;
            $odetail->order_id     = $order_id;
            $odetail->product_id   = $product->id;
            $odetail->name         = $product->name;
            $odetail->qnty         = $product->qty;
            $odetail->unit_price   = $product->price;
            $odetail->save();

        }

        Cart::destroy();
        Toastr::success('Invoice Confirm Added on order table');
        return redirect()->route('order.index');

    }

}
