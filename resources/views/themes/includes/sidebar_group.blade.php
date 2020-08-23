<div class="list-col-left">
    <div class="nav-left">
        <div class="nav-group">
            <h3>NHÓM SẢN PHẨM</h3>
            <ul>
                @foreach($listgroups as $key=>$value)
                    <li><a href="{{url('nhom-san-pham/'.$value->slug)}}">{{$value->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div><!-- /.list-col-left -->