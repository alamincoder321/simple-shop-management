@extends('layouts.app')

@section('pos')
	active
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6">
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <h3 class="panel-title">Category</h3>
		        </div>
		        <div class="panel-body">
		        	@foreach($categories as $category)
		            <button type="button" class="btn btn-info waves-effect waves-light w-sm m-b-5">{{$category->name}}</button>
		            @endforeach	            
		        </div>
		    </div>
		</div>

		<div class="col-md-6">
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <h3 class="panel-title">Brand</h3>
		        </div>
		        <div class="panel-body">
		        	@foreach($brands as $brand)
		            <button type="button" class="btn btn-purple waves-effect waves-light w-sm m-b-5">{{$brand->name}}</button>
		            @endforeach	            
		        </div>
		    </div>
		</div>
	</div>

    <div class="row">

    	<div class="col-sm-6 col-md-6">
            <div class="price_card text-center">
            	<h4 class="bg-info text-center text-white"> Invoice Product </h4>
            	<table class="table">
            		<thead>
            			<tr>
            				<th class="text-center">Sl</th>
            				<th class="text-center">Name</th>
            				<th class="text-center">Qty</th>
            				<th class="text-center">Total Price</th>
            				<th class="text-center">Action</th>
            			</tr>
            		</thead>
            		<tbody>
            			@php
            			$i =1;
            			$carts = Cart::content();
            			@endphp
            			@foreach($carts as $cart)
            			<tr>
            				<td>{{$i++}}</td>
            				<td>{{$cart->name}}</td>
            				<td class="d-flex justify-content-between">
            					<form action="{{route('cart.update', $cart->rowId)}}" method="POST">
            						@csrf
            					<input type="number" name="qty" value="{{$t=$cart->qty}}" style="width:50px; height: 29px;">
            					<button type="submit" class="btn btn-primary btn-sm" style="margin:0; padding: 2px 7px;"><i class="fa fa-check-square"></i></button>
            					</form>
            				</td>
            				<td>{{$cart->price * $cart->qty}}</td>
            				<td>
            					<a href="{{route('cart.remove', $cart->rowId)}}"><i class="fa fa-trash"></i></a>
            				</td>
            			</tr>
            			@endforeach
            		</tbody>
            	</table>
                <div class="pricing-header bg-primary"><br>
                	<span class="name">Quantity: {{Cart::count()}}</span>
                    <span class="name">SubTotal: {{Cart::subtotal()}}</span>
                    <span class="name">Vat Tax: {{Cart::tax()}}</span>
                    <hr><br>
                    <span class="name">Total: {{Cart::total()}}</span>
                </div>
            
                <div class="panel">
                	<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus-square"></i> Add New Customer</button>
                <form action="{{route('invoice')}}" method="POST">
    			@csrf
	            	<select class="form-control" name="customer_id">
	            		<option label="Select Customer Name"></option>
	            		@foreach($customers as $customer)
	            		<option value="{{$customer->id}}">{{$customer->name}}</option>
	            		@endforeach
	            	</select>
	            	@if ($errors->has('customer_id'))
                        <span class="text-danger">{{$errors->first('customer_id')}}</span>
                    @endif
            	</div>
            	
            	<button type="submit" class="btn btn-success btn-lg text-center">Invoice</button>
            </form>
            </div> <!-- end Pricing_card -->
        

        </div>

        <!-- Product tabel here ----->

	    <div class="col-md-6">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Product table </h3>
	            </div>
	            <div class="panel-body">
	                <div class="row">
	                    <div class="col-md-12 col-sm-12 col-xs-12">
	                        <table id="datatable" class="table table-striped table-bordered">
	                            <thead>
	                                <tr>
	                                    <th>Image</th>
	                                    <th>Name</th>
	                                    <th>Code</th>
	                                    <th>Price</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>

	                            <tbody>	                            
	                            	@foreach($products as $product)
	                            	<tr>
	                            	<form action="{{route('cart.add')}}" method="POST">
	                            	@csrf

	                            	<input type="hidden" name="id" value="{{$product->id}}">
	                            	<input type="hidden" name="name" value="{{$product->name}}">
	                            	<input type="hidden" name="qty" value="1">
	                            	<input type="hidden" name="price" value="{{$product->price}}">
	                            		<td>
	                            			<img src="{{asset($product->image)}}" width="50" height="50">
	                            		</td>
	                            		<td>{{$product->name}}</td>
	                            		<td>{{$product->code}}</td>
	                            		<td>{{$product->price}}</td>
	                            		<td><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i></button></td>
	                            	</form>
	                            	</tr>
	                            	@endforeach
	                            </tbody>

	                        </table>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>    
	</div> <!-- End Row -->

	<!-- Modal content  --->

	<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog"> 
		    <div class="modal-content"> 
		        <div class="modal-header"> 
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
		            <h4 class="modal-title"> Customer Add </h4> 
		        </div>
		        <form action="{{route('customer.store')}}" method="POST">
		        @csrf 
		        <div class="modal-body"> 
		            <div class="row"> 
		                <div class="col-md-6"> 
		                    <div class="form-group"> 
		                        <label for="field-1" class="control-label">Name</label> 
		                        <input type="text" name="name" class="form-control">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
		                    </div> 
		                </div> 
		                <div class="col-md-6"> 
		                    <div class="form-group"> 
		                        <label for="field-2" class="control-label">City</label> 
		                        <input type="text" name="city" class="form-control">
		                            @if ($errors->has('city'))
                                    <span class="text-danger">{{$errors->first('city')}}</span>
                                    @endif 
		                    </div> 
		                </div> 
		            </div> 
		            <div class="row"> 
		                <div class="col-md-6"> 
		                    <div class="form-group"> 
		                        <label for="field-3" class="control-label">Village</label> 
		                        <input type="text" name="village" class="form-control">
			                        @if ($errors->has('village'))
	                                 <span class="text-danger">{{$errors->first('village')}}</span>
	                                @endif 
		                    </div> 
		                </div> 

		                <div class="col-md-6"> 
		                    <div class="form-group"> 
		                        <label for="field-4" class="control-label">Phone</label> 
		                        <input type="text" name="phone" class="form-control">
		                            @if ($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif 
		                    </div> 
		                </div> 
		            </div>
		        <div class="modal-footer"> 
		            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
		            <button type="submit" class="btn btn-info waves-effect waves-light">Add Customer</button> 
		        </div>
		        </form> 
		    </div> 
		</div>
	</div><!-- /.modal -->
@endsection