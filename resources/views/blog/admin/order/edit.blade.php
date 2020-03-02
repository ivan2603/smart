@extends('layouts.app_admin')
@section('content')
<section class="content-header">
    <h1>Edit order ID {{$item->id}}
        @if(!$order->status)
            <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=1" class="btn btn-success btn-xs">Approve</a>
            <a href="{{route('blog.admin.orders.show', $item->id)}}" class="btn btn-danger btn-xs refund">Refund</a>
        @else
            <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=0" class="btn btn-default btn-xs edit">Return for revision</a>
            <a class="btn btn-xs" href="#">
                <form id="delete" method="post" action="{{route('blog.admin.orders.destroy', $item->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-warning btn-xs">Move to archive</button>
                </form>
            </a>
        @endif
    </h1>
    @component('blog.admin.components.breadcrumb')
    @slot('parent') Home @endslot
    @slot('order') Order list @endslot
    @slot('active') Order {{$item->id}} @endslot
    @endcomponent
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <form action="{{route('blog.admin.orders.store')}}" method="post">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Order ID:</td>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Created at:</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Updated at:</td>
                                        <td>{{$order->updated_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total amount</td>
                                        <td>{{count($orderProducts)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>{{$order->sum}} {{$order->currency}}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer name</td>
                                        <td>{{$order->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$order->status ? 'Completed' : 'Processed'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td>{{$order->note ?? $order->note}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{--<input type="submit" name="submit" class="btn btn-warning" value="Save">--}}
                    </div>
                </div>
            </div>
            <h3>Order Details</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $qty = 0 @endphp
                            @foreach($orderProducts as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->qty, $qty+=$product->qty}}</td>
                                    <td>{{$product->price}}</td>
                                </tr>
                            @endforeach
                            <tr class="active">
                                <td colspan="2">Total:</td>
                                <td><b>{{$qty}}</b></td>
                                <td><b>{{$order->sum}} {{$order->currency}}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection