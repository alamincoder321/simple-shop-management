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
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Customer Name</label>
                                <div class="col-lg-10">
                                    <input type="text" id="name" class=" form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-2">City</label>
                                <div class="col-lg-10">
                                    <input type="text" id="city" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Village</label>
                                <div class="col-lg-10">
                                    <input type="text" id="village" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Phone Number</label>
                                <div class="col-lg-10">
                                    <input type="text" id="phone" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right customerAdd" type="submit">Add Customer</button>
                                </div>
                            </div>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection

@push('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function clear(){
        $('#name').val("");        
        $('#city').val("");
        $('#village').val("");
        $('#phone').val("");
    }

    $(".customerAdd").click(function(){
        var name = $('#name').val();
        var city = $('#city').val();
        var village = $('#village').val();
        var phone = $('#phone').val();
        
        $.ajax({
            method: "POST",
            datatype: "json",
            url: "/customer/",
            data: {name:name,
                    city:city,
                    village:village,
                    phone:phone},
            success: function(data){
                console.log(data.name);
                alertify.set('notifier','position', 'top-right');
                alertify.success('Successfully added data.');
                clear();
            }
        })
    })
</script>
@endpush
