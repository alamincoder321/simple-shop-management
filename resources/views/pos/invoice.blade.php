@include('layouts.backend.style')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="clearfix">
                            <div class="text-center">
                                <h4>Eashan Computer Sales & Service Center</h4>
                                <h6>Saidpur Plaza, <span>Saidpur</span></h6>
                                <p>Name: Md. Mosadul Islam (Mintu)</p>
                                <span>Mobile: 01718726362</span>
                                
                            </div>
                            <div class="pull-right">
                                <h4>Invoice # <br>
                                    <strong>{{date("F j, Y")}}</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="pull-left m-t-30">
                                    <address>
                                      <strong>Customer Name:  {{$customer->name}}</strong><br>
                                      Address: {{$customer->village}}, {{$customer->city}}
                                      </address>
                                </div>
                                <div class="pull-right m-t-30">
                                    <p><strong>Order Date: {{date("d.m.Y")}}</strong> </p>
                                    <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                    <p class="m-t-10"><strong>Order ID: </strong> 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="m-h-50"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr><th>Sl</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Total</th>
                                        </tr></thead>
                                        <tbody>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($content as $cart)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$cart->name}}</td>
                                                <td>{{$cart->qty}}</td>
                                                <td>{{$cart->price}}</td>
                                                <td>{{$cart->price * $cart->qty}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="border-radius: 0px;">
                            <div class="col-md-3 col-md-offset-9">
                                <p class="text-right"><b>Sub-total:</b> {{Cart::subtotal()}}</p>
                                <p class="text-right">VAT: {{Cart::tax()}}</p>
                                <hr>
                                <h3 class="text-right">Total: {{Cart::total()}}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="hidden-print">
                            <div class="pull-right">
                                <a  onclick="window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Modal content  --->

    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title"> Invoice Of: {{$customer->name}} </h4>
                    @php
                        $total = str_replace('.00', '', Cart::subtotal());
                    @endphp 
                    <span class="pull-right">Sub-Total: {{$total}}</span> 
                </div>
                <form action="{{route('final.invoice')}}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{$customer->id}}"> 
                <input type="hidden" name="t_qty" value="{{Cart::count()}}"> 
                <input type="hidden" name="pay_date" value="{{date("d.m.Y")}}"> 
                <div class="modal-body"> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Payment-Type</label> 
                                <select class="form-control" name="type">
                                    <option value="handcash">Handcash</option>
                                    <option value="handcash">Bkash</option>
                                </select>
                                    @if ($errors->has('type'))
                                    <span class="text-danger">{{$errors->first('type')}}</span>
                                    @endif
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-2" class="control-label">Total-Payment</label>
                                @php
                                    $total = str_replace(',', '', Cart::subtotal());
                                    $t     = str_replace('.00', '', $total);
                                @endphp 
                                <input type="text" name="pay" class="form-control" value="{{$t}}">
                                    @if ($errors->has('pay'))
                                    <span class="text-danger">{{$errors->first('pay')}}</span>
                                    @endif 
                            </div> 
                        </div>
                    </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-info waves-effect waves-light">Final Invoice</button> 
                </div>
                </form> 
            </div> 
        </div>
    </div><!-- /.modal -->

@include('layouts.backend.script')