@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
        @slot('title') Orders <a style="cursor: pointer" href="{{route('blog.admin.orders.create')}}" type="button" class="btn btn-warning">Create order</a> @endslot
        @slot('parent') Home @endslot
        @slot('order') Order list @endslot
        @slot('active') Create order @endslot
        @endcomponent
    </section>
@endsection