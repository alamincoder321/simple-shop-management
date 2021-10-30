@extends('layouts.app')
@section('product')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Product</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('home')}}">Shop-Management</a></li>
                <li class="active"> Product List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('product.create')}}" class="btn btn-info btn-sm pull-right">Add Product</a>
                    <h3 class="panel-title">Product list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $key=>$product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img src="{{asset($product->image)}}" width="60" height="60">
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->brand->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->price}}</td>
                                        <td class="text-right">
                                          @if($product->status == 1)
                                            <a href="{{route ('product.inactive', $product->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('product.active', $product->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif

                                          <a href="{{route ('product.edit', $product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                          <a href="javascript:;" data-id="{{$product->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('product.destroy', $product->id)}}" id="delete{{$product->id}}" method="POST">
                                              @csrf
                                              @method('DELETE')                    
                                            </form>
                                        </td>
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

@endsection
