@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
        @slot('title') Create category @endslot
        @slot('parent') Home @endslot
        @slot('category') Category list @endslot
        @slot('active') Create category @endslot
        @endcomponent
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form action="{{route('blog.admin.categories.store', $entity->id)}}" method="post" data-toggle="validator">
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="title">Category name</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Category name"
                                required value="{{old('title', $entity->title)}}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <select name="parent_id" id="parent_id" class="form-control" required>
                                    <option value="0">-- self category -- </option>
                                    @include('blog.admin.category.include.all_categories', ['categories' => $categories])
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <input class="form-control" type="text" name="keywords" id="keywords" placeholder="Keywords"
                                value="{{old('keywords', $entity->keywords)}}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" type="text" name="description" id="description" placeholder="Description"
                                value="{{old('description', $entity->description)}}" required>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection