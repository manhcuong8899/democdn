<div class="list-col-left">
    <div class="nav-left">
        <div class="nav-group">
            @if($cate->parent_id!=0)
            <h3>{{$cate->parent->name}}</h3>
            <ul>
                @foreach($cate->parent->children as $key=>$value)
                <li><a href="{{url($value->slug)}}">{{$value->name}}</a></li>
                @endforeach
            </ul>
                @else
                <h3>{{$cate->name}}</h3>
                <ul>
                    @foreach($cate->children as $key=>$value)
                        <li><a href="{{url($value->slug)}}">{{$value->name}}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div><!-- /.list-col-left -->