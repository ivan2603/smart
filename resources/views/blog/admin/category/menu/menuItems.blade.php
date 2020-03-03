@foreach($items as $item)
    <p class="item-p">
        <a class="list-group-item" href="{{route('blog.admin.categories.edit', $item->id)}}">{{$item->title}}</a>
        <span>
            @if(!$item->hasChildren())
                <a href="{{route('blog.admin.categories.delete', $item->id)}}" class="delete">
                    <i class="fa fa-fw fa-close text-danger"></i>
                </a>
            @else
                <i class="fa fa-fw fa-close"></i>
            @endif
        </span>
    </p>
    @if($item->hasChildren())
        <div class="list-group">
            @include('blog.admin.category.menu.menuItems', ['items' => $item->children()])
        </div>
    @endif
@endforeach