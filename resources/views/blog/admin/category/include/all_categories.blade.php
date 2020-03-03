@foreach($categories as $category)
    <option value="{{$category->id ?? ""}}"
    @isset($entity->id)
        @if($category->id == $entity->parent_id) selected
            @endif
        @if($category->id == $entity->id) disabled
        @endif
    @endisset
    >
        {!! $delimiter ?? "" !!} {{$category->title ?? ""}}
    </option>
    @if(count($category->children) > 0)
        @include('blog.admin.category.include.all_categories', [
        'categories' => $category->children,
        'delimiter' => ' - '.$delimiter
        ])
    @endif
@endforeach