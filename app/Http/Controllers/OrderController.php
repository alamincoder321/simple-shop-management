<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Customer;
class OrderController extends Controller
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
        $orders = Order::latest()->get();
        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderdetails = Orderdetail::where('order_id', $id)->get();
        return view('order.order_invoice', compact('order', 'orderdetails'));
    }

    public function updatedue(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->customer_id = $request->customer_id;
        $order->t_qty = $request->t_qty;
        $order->pay_date = $request->pay_date;
        $order->type = $request->type;
        $order->pay = $request->pay;
        $order->due = $request->due;
        $order->update();

        Toastr::success('Due update successfully');
        return redirect()->route('order.index');
    }
}
