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
                                <h4>Invoice  <br>
                                    <strong>{{date("F j, Y")}}</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="pull-left m-t-30">
                                    <address>
                                      <strong>Customer Name: {{$order->customer->name}}</strong><br>
                                      Address: {{$order->customer->village}}, {{$order->customer->city}} 
                                      </address>
                                </div>
                                <div class="pull-right m-t-30">
                                    <p><strong>Order Date: {{$order->pay_date}}</strong> </p>
                                    <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Sold</span></p>
                                    <p class="m-t-10"><strong>Order ID: </strong> {{$order->id}}</p>
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
                                            @foreach($orderdetails as $key=>$row)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->qnty}}</td>
                                                <td>{{$row->unit_price}}</td>
                                                <td>{{$row->qnty * $row->unit_price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="border-radius: 0px;">
                            <div class="col-md-3 col-md-offset-9">
                                <p class="text-right"><b>Sub-total:</b> {{$order->pay}}</p>
                                <p class="text-right">Due: @if($order->due ===Null) 00 @else {{$order->due}}@endif</p>
                                <hr>
                                <h3 class="text-right">Total: {{$order->pay}}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="hidden-print">
                            <div class="pull-right">
                                <a  onclick="window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                <a href="{{route('order.index')}}" class="btn btn-primary waves-effect waves-light">Back to Orderdetails</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@include('layouts.backend.script')