@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
        @slot('title') Orders <a style="cursor: pointer" href="{{route('blog.admin.orders.create')}}" type="button" class="btn btn-warning">Create order</a> @endslot
        @slot('parent') Home @endslot
        @slot('active') Order list @endslot
        @endcomponent
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Customer</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Total Sum</th>
                                        <th class="text-center">Date created</th>
                                        <th class="text-center">Date updated</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    @php $class = $order->status ? 'success' : '' @endphp
                                <tr class="{{$class}}">
                                    <td class="text-center">{{$order->id}}</td>
                                    <td class="text-center">{{$order->name}}</td>
                                    <td class="text-center">
                                        @if($order->status == 0) Processed @endif
                                        @if($order->status == 1) Completed @endif
                                        @if($order->status == 2) Moved to archive @endif
                                    </td>
                                    <td class="text-center">{{$order->sum}} {{$order->currency}}</td>
                                    <td class="text-center">{{$order->created_at}}</td>
                                    <td class="text-center">{{$order->updated_at}}</td>
                                    <td class="text-center">
                                        @if($order->status == 2)
                                            <a href="{{route('blog.admin.orders.edit', $order->id)}}" title="restore order"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                            <a href="" title="delete order"><i class="fa fa-fw fa-close text-danger"></i></a>
                                        @elseif($order->status == 1)
                                            <a href="{{route('blog.admin.orders.edit', $order->id)}}" title="edit order"><i class="fa fa-fw fa-eye"></i></a>
                                            <a href="" title="delete order"><i class="fa fa-fw fa-close text-danger"></i></a>
                                        @else
                                            <a href="{{route('blog.admin.orders.edit', $order->id)}}" title="edit order"><i class="fa fa-fw fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="3"><h2>Nothing to show</h2></td>
                                </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p>{{count($orders)}} order(s) out of {{$countOrders}}</p>
                            @if($orders->total() > $orders->count())
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                {{$orders->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection