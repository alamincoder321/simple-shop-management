@extends('layouts.app')
@section('employee')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Employee</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('home')}}">Shop-Management</a></li>
                <li class="active"> Update Employee </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('employee.index')}}" class="btn btn-info btn-sm pull-right">Employee List</a>
                    <h3 class="panel-title">Update Employee</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('employee.update', $employee->id)}}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Employee Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class=" form-control" autocomplete="off" value="{{$employee->name}}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">E-Mail</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" autocomplete="off" value="{{$employee->email}}">
                                     @if ($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Salary</label>
                                <div class="col-lg-10">
                                    <input type="number" name="salary" class="form-control" autocomplete="off" value="{{$employee->salary}}">
                                    @if ($errors->has('salary'))
                                    <span class="text-danger">{{$errors->first('salary')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">City</label>
                                <div class="col-lg-10">
                                    <input type="text" name="city" class="form-control" autocomplete="off" value="{{$employee->city}}">
                                    @if ($errors->has('city'))
                                    <span class="text-danger">{{$errors->first('city')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Village</label>
                                <div class="col-lg-10">
                                    <input type="text" name="village" class="form-control" autocomplete="off" value="{{$employee->village}}">
                                    @if ($errors->has('village'))
                                    <span class="text-danger">{{$errors->first('village')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Phone Number</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone" class="form-control" autocomplete="off" value="{{$employee->phone}}">
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Employee Image</label>
                                <div class="col-lg-10">
                                    <img src="{{asset($employee->image)}}" width="80" height="80">
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="image" value="{{$employee->image}}">

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update Employee</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
