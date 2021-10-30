@extends('layouts.app')
@section('brand')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Brand</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('home')}}">Shop-Management</a></li>
                <li class="active"> Update Brand </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('brand.index')}}" class="btn btn-info btn-sm pull-right">Brand List</a>
                    <h3 class="panel-title">Update Brand</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('brand.update', $brand->id)}}" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Brand Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class=" form-control" autocomplete="off" value="{{$brand->name}}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update Brand</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
