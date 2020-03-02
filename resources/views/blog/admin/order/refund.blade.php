@extends('layouts.app_admin')
@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
        @slot('parent') Home @endslot
        @slot('order') Order list @endslot
        @slot('active') Refund Order {{$id}} @endslot
        @endcomponent
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h3>Order Details</h3>
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <form id="refund" method="post" action="">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="4" id="order" class="text-center">Order Id {{$id}}</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderProductsRefund as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->qty}}</td>
                                            <td>{{$product->price}} {{$order->currency}}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                           <th colspan="3">Subtotal :</th>
                                           <td><b>{{$order->sum}} {{$order->currency}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @method('PUT')
                                @csrf
                                <input type="submit" name="submit" class="btn btn-warning" value="Refund">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

