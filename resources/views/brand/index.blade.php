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
                <li class="active"> Brand List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('brand.create')}}" class="btn btn-info btn-sm pull-right">Add Brand</a>
                    <h3 class="panel-title">Brand list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($brands as $key=>$brand)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td class="text-right">
                                          @if($brand->status == 1)
                                            <a href="{{route ('brand.inactive', $brand->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('brand.active', $brand->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif

                                            <a  data-id="{{$brand->id}}"  class="btn btn-info btn-sm brandShow" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-edit"></i></a>

                                            <a href="javascript:;" data-id="{{$brand->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('brand.destroy', $brand->id)}}" id="delete{{$brand->id}}" method="POST">
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

    <!-- Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">UPDATE BRAND</h4> 
                </div> 
                <div class="modal-body"> 
                    <div class="row"> 
                        <div class="col-md-12">
                        <input type="hidden" class="item_id"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Brand Name</label> 
                                <input type="text" class="form-control" id="name" autocomplete="off"> 
                            </div>                             
                        </div>
                    </div>
                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-info waves-effect waves-light brandUpdate">Update</button> 
                </div> 
            </div> 
        </div>
    </div><!-- /.modal -->

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

    $(".brandShow").click(function(){
        var id = $(this).data('id');
        $.ajax({
            method: "GET",
            url: "/brand/"+id+"/edit",
            data: {"id":id},
            datatype:"json",
            success: function(data){
                console.log(data);
                $('.item_id').val(data.id);
                $('#name').val(data.name);
            }
        })
    })

    $(".brandUpdate").click(function(){
        var id = $(".item_id").val();
        var name = $('#name').val();

        $.ajax({
            method: "PUT",
            datatype: "json",
            url: "/brand/"+id,
            data: {name:name},
            success: function(data){
                alertify.set('notifier','position', 'top-right');
                alertify.success('Successfully Update data.');
                $("#con-close-modal").remove();
                window.location.reload();
            }
        })
    })

</script>
@endpush
