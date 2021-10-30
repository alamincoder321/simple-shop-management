@extends('layouts.app')
@section('order')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Order</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('home')}}">Shop-Management</a></li>
                <li class="active"> Order List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Order list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Customer Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Pay-date</th>
                                        <th class="text-center">Payment-type</th>
                                        <th class="text-center">Total-pay</th>
                                        <th class="text-center">Due</th>
                                        <th class="text-center">Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $key=>$order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->customer->name}}</td>
                                        <td>{{$order->t_qty}}</td>
                                        <td>{{$order->pay_date}}</td>
                                        <td>{{$order->type}}</td>
                                        <td>{{$order->pay - $order->due}}</td>
                                        <td>
                                            @if($order->due === Null)
                                            <input value="0" readonly style="width:80px;">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$order->id}}"><i class="fa fa-edit"></i></button>
                                            @else
                                                <span>{{$order->due}}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{route('order.show', $order->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></td>
                                    </tr>


<!-- Modal content  --->
<div class="modal fade" id="{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Customer due</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<form action="{{route('update.due', $order->id)}}" method="POST">
    @csrf
    <input type="hidden" name="customer_id" value="{{$order->customer_id}}">
    <input type="hidden" name="t_qty" value="{{$order->t_qty}}">
    <input type="hidden" name="pay_date" value="{{$order->pay_date}}">
    <input type="hidden" name="type" value="{{$order->type}}">
    <input type="hidden" name="pay" value="{{$order->pay}}">
  <div class="modal-body">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label>Due</label>
                <input type="text" name="due" class="form-control">
            </div>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Due Update</button>
  </div>
</form>
</div>
</div>
</div><!-- /.modal -->
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- End Row -->

@endsection
