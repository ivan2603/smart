@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
        @slot('title') Categories @endslot
        @slot('parent') Home @endslot
        @slot('active') Category list @endslot
        @endcomponent
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div style="width: 100%">
                            <small style="margin-left: 0">For edit category please click on category.</small>
                            <small style="margin-left: 5%">Cannot delete category which has child category or products.</small>
                        </div>
                        <br>
                        @if($menu)
                            <div class="list-group list-group-root well">
                                @include('blog.admin.category.menu.menuItems', ['items' => $menu->roots()])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection