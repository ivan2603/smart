<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Last orders</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Sum</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lastOrders as $order)
                    <tr>
                        <td><a href=""></a>{{$order->id}}</td>
                        <td><a href=""></a>{{ucfirst($order->name)}}</td>
                        <td><span class="label label-success">
                                @if($order->status == 0) Processed
                                @endif
                                @if($order->status == 1) Completed
                                    @endif
                                @if($order->status == 2) <b>Moved to archive</b>
                                    @endif
                            </span>
                        </td>
                        <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">{{$order->sum}} {{$order->currency}}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="box-footer clarfix">
        <a href="{{route('blog.admin.orders.index')}}" class="btn btn-sm btn-info btn-flat pull-left">All orders</a>
    </div>
</div>
</div>