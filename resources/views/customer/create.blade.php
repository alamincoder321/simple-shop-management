@extends('layouts.app')
@section('customer')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Customer</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('home')}}">Shop-Management</a></li>
                <li class="active"> Add Customer </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('customer.index')}}" class="btn btn-info btn-sm pull-right">Customer List</a>
                    <h3 class="panel-title">Add Customer</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('customer.store')}}" novalidate="novalidate">
                            @csrf
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Customer Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class=" form-control" autocomplete="off">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-2">City</label>
                                <div class="col-lg-10">
                                    <input type="text" name="city" class="form-control" autocomplete="off">
                                    @if ($errors->has('city'))
                                    <span class="text-danger">{{$errors->first('city')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Village</label>
                                <div class="col-lg-10">
                                    <input type="text" name="village" class="form-control" autocomplete="off">
                                    @if ($errors->has('village'))
                                    <span class="text-danger">{{$errors->first('village')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Phone Number</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone" class="form-control" autocomplete="off">
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add Customer</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
