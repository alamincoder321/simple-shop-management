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
                <li class="active"> Add Brand </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('brand.index')}}" class="btn btn-info btn-sm pull-right">Brand List</a>
                    <h3 class="panel-title">Add Brand</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group ">
                        <label class="control-label col-lg-2">Brand Name</label>
                        <div class="col-lg-10">
                            <input type="text" id="name" class=" form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success waves-effect waves-light pull-right brandAdd" type="submit">Add Brand</button>
                        </div>
                    </div>
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
    }

    $(".brandAdd").click(function(){
        var name = $('#name').val();

        $.ajax({
            method: "POST",
            datatype: "json",
            url: "/brand/",
            data: {name:name},
            success: function(data){
                alertify.set('notifier','position', 'top-right');
                alertify.success('Successfully added data.');
                clear();
            }
        })
    })
</script>
@endpush
