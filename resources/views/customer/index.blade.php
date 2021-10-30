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
                <li class="active"> Customer List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('customer.create')}}" class="btn btn-info btn-sm pull-right">Add Customer</a>
                    <h3 class="panel-title">Customer list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Village</th>
                                        <th>Number</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($customers as $key=>$customer)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->city}}</td>
                                        <td>{{$customer->village}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td class="text-right">
                                          @if($customer->status == 1)
                                            <a href="{{route ('customer.inactive', $customer->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('customer.active', $customer->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif

                                          <a href="{{route ('customer.edit', $customer->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                          <a href="javascript:;" data-id="{{$customer->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('customer.destroy', $customer->id)}}" id="delete{{$customer->id}}" method="POST">
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
