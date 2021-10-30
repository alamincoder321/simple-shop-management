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
                <li class="active"> Update Product </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('product.index')}}" class="btn btn-info btn-sm pull-right">Product List</a>
                    <h3 class="panel-title">Update Product</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Product Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class=" form-control" autocomplete="off" value="{{$product->name}}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Product Price</label>
                                <div class="col-lg-10">
                                    <input type="number" name="price" class="form-control" autocomplete="off" value="{{$product->price}}">
                                     @if ($errors->has('price'))
                                    <span class="text-danger">{{$errors->first('price')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Product Qty</label>
                                <div class="col-lg-10">
                                    <input type="number" name="qty" class="form-control" autocomplete="off" value="{{$product->qty}}">
                                    @if ($errors->has('qty'))
                                    <span class="text-danger">{{$errors->first('qty')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Product Code</label>
                                <div class="col-lg-10">
                                    <input type="text" name="code" class="form-control" autocomplete="off" value="{{$product->code}}">
                                    @if ($errors->has('code'))
                                    <span class="text-danger">{{$errors->first('code')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Brand Name</label>
                                <div class="col-lg-10">
                                    <select name="brand_id" class="form-control">
                                        <option label="Select Brand Name"></option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected':''}}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('brand_id'))
                                    <span class="text-danger">{{$errors->first('brand_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-2">Category Name</label>
                                <div class="col-lg-10">
                                    <select name="category_id" class="form-control">
                                        <option label="Select Brand Name"></option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                    <span class="text-danger">{{$errors->first('category_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-2">Product Image</label>
                                <div class="col-lg-10">
                                    <img src="{{asset($product->image)}}" width="80" height="80">
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
