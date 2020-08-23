@can('config_management')
<li class="header"><i class="fa fa-bars" style="margin-right:5px;"></i> QUẢN TRỊ WEBSITE</li>
@endcan

@can('categories_management')
    <li class="treeview {{setMenuActive('admin/cate')}}">
        <a href="#">
            <i class="fa fa-list"></i>
            <span>Danh mục</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @foreach(categories() as $value)
                <li class="{{ setMenuActive('admin/cate/'.$value->code) }}"><a href="{{url('admin/cate/'.$value->code)}}"><i class="fa {{$value->fa}}"></i>Danh mục {{$value->name}}</a></li>
            @endforeach
        </ul>

    </li>
@endcan
@can('info_management')
    <li class="treeview {{setMenuActive('admin/articles')}}">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span>Biên tập nội dung</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @foreach(articles() as $value)
                <li class="{{ setMenuActive('admin/articles/'.$value->code) }}"><a href="{{url('admin/articles/'.$value->code)}}"><i class="fa {{$value->fa}}"></i>Danh sách {{$value->name}}</a></li>
            @endforeach
        </ul>
    </li>
@endcan
@can('product_management')
    <li class="treeview {{setMenuActive('admin/products')}}">
        <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Quản lý sản phẩm</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/products') }}"><a href="{{url('admin/products')}}"><i class="fa fa-list"></i>Danh sách sản phẩm</a></li>
            <li class="{{ setMenuActive('admin/create/products') }}"><a href="{{url('admin/create/products')}}"><i class="fa fa-plus"></i>Thêm mới sản phẩm</a></li>
            <li class="{{ setMenuActive('admin/groupproducts') }}"><a href="{{url('admin/groupproducts')}}"><i class="fa fa-object-group"></i>Quản lý nhóm sản phẩm</a></li>
            <li class="{{ setMenuActive('admin/products/import') }}"><a href="{{url('admin/products/import')}}"><i class="fa fa-file-excel-o"></i>Nhập liệu- Sửa đổi Excel</a></li>
        </ul>
    </li>
@endcan

    <li class="treeview {{setMenuActive('admin/coupons')}}">
        <a href="{{url('admin/coupons')}}">
            <i class="fa fa-gift"></i>
            <span>Quản lý mã giảm giá</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    </li>

@can('image_management')
    <li class="treeview {{setMenuActive('admin/images')}}">
        <a href="#">
            <i class="fa fa-picture-o"></i>
            <span>Quản lý hình ảnh</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/images') }}"><a href="{{url('admin/images')}}"><i class="fa fa-child"></i>Danh sách hình ảnh</a></li>
            <li class="{{ setMenuActive('admin/create/images') }}"><a href="{{url('admin/create/images')}}"><i class="fa fa-child"></i>Thêm mới hình ảnh</a></li>
        </ul>
@endcan

@can('menu_management')
<li class="treeview {{setMenuActive('admin/menus')}}">
    <a href="#">
        <i class="fa fa-bars"></i>
        <span>Quản lý menu</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        @foreach(Menus() as $value)
        <li class="{{ setMenuActive('admin/menus/'.$value->code) }}"><a href="{{url('admin/menus/'.$value->code)}}"><i class="fa fa-child"></i>{{$value->name}}</a></li>
        @endforeach
    </ul>
</li>
@endcan
@can('config_management')
<li class="treeview {{ setMenuActive('admin/config') }}">
    <a href="#">
        <i class="fa fa-cog"></i>
        <span>Quản lý cấu hình</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ setMenuActive('admin/settings/general') }}"><a href="{{url('admin/settings/general')}}"><i class="fa fa-child"></i>Cấu hình chung</a></li>
        <li class="{{ setMenuActive('admin/content') }}"><a href="{{url('admin/content')}}"><i class="fa fa-child"></i>Cấu hình chức năng Website</a></li>
        <li class="{{ setMenuActive('admin/banks') }}"><a href="{{url('admin/banks')}}"><i class="fa fa-child"></i>Cấu hình TK Ngân hàng</a></li>
        <li class="{{ setMenuActive('admin/cate/properties') }}"><a href="{{url('admin/properties')}}"><i class="fa fa-child"></i>Thuộc tính sản phẩm</a></li>
        <li class="{{ setMenuActive('admin/units') }}"><a href="{{url('admin/units')}}"><i class="fa fa-child"></i>Đơn vị sản phẩm</a></li>
        <li class="{{ setMenuActive('admin/currency') }}"><a href="{{url('admin/currency')}}"><i class="fa fa-child"></i>Tỷ giá</a></li>
        <li class="{{ setMenuActive('admin/userlevel') }}"><a href="{{url('admin/userlevel')}}"><i class="fa fa-child"></i>Cấp độ & chiết khấu</a></li>
        <li class="{{ setMenuActive('admin/support') }}"><a href="{{url('admin/support')}}"><i class="fa fa-child"></i>Hỗ trợ tuyến vận chuyển</a></li>
    </ul>
</li>
@endcan
@can('config_management')
    <li class="header"><i class="fa fa-bars" style="margin-right:5px;"></i> QUẢN LÝ KINH DOANH</li>
@endcan
@can('orderonline_management')
    <li class="treeview {{ setMenuActive('admin/order/online') }}">
        <a href="#">
            <i class="fa fa-child"></i>
            <span>Quản lý đơn hàng</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/order/online') }}"><a href="{{url('admin/order/online')}}"><i class="fa fa-child"></i>Tất cả đơn hàng</a></li>
            @foreach(GetStatusOrder() as $value)
            <li class="{{ setMenuActive('admin/order/online/'.$value->code) }}"><a href="{{url('admin/order/online/'.$value->code)}}"><i class="fa fa-child"></i>{{$value->name}}</a></li>
            @endforeach
        </ul>
    </li>
@endcan

@can('statistical_management')
    <li class="treeview {{ setMenuActive('admin/statistical') }}">
        <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Báo cáo</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/report/online') }}"><a href="{{url('admin/report/online')}}"><i class="fa fa-globe"></i>Báo cáo mua hàng Online</a></li>
        </ul>
    </li>
@endcan

@can('customer_management')
    <li class="treeview {{ setMenuActive('admin/customer') }}">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Quản lý khách hàng</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/customer') }}"><a href="{{url('admin/customer')}}"><i class="fa fa-list"></i>Tất cả khách hàng</a></li>
            <li class="{{ setMenuActive('admin/customer/gold') }}"><a href="{{url('admin/customer/gold')}}"><i class="fa fa-user-secret"></i>Thành viên vàng</a></li>
            <li class="{{ setMenuActive('admin/customer/silver') }}"><a href="{{url('admin/customer/silver')}}"><i class="fa fa-user-circle-o"></i>Thành viên bạc</a></li>
            <li class="{{ setMenuActive('admin/customer/bronze') }}"><a href="{{url('admin/customer/bronze')}}"><i class="fa fa-user-secret"></i>Thành viên đồng</a></li>
            <li class="{{ setMenuActive('admin/customer/regular') }}"><a href="{{url('admin/customer/regular')}}"><i class="fa fa-user-secret"></i>Thành viên thường</a></li>

        </ul>
    </li>
@endcan
@can('notification_management')
    <li class="treeview {{ setMenuActive('admin/notification/users') }}">
        <a href="#">
            <i class="fa fa-bell"></i>
            <span>Thông báo khách hàng</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/notification/users/systems') }}"><a href="{{url('admin/notification/users/systems')}}"><i class="fa fa-newspaper-o"></i>Thông báo chung</a></li>
            <li class="{{ setMenuActive('admin/notification/users/orders') }}"><a href="{{url('admin/notification/users/orders')}}"><i class="fa fa-shopping-cart"></i>Thông báo về đơn hàng</a></li>
            <li class="{{ setMenuActive('admin/notification/users/package') }}"><a href="{{url('admin/notification/users/package')}}"><i class="fa fa-dropbox"></i>Thông báo về kiện hàng</a></li>
            <li class="{{ setMenuActive('admin/notification/users/compaint') }}"><a href="{{url('admin/notification/users/compaint')}}"><i class="fa fa-envelope"></i>Thông báo về khiếu nại</a></li>
        </ul>
    </li>
@endcan

@can('sendemail_management')
    <li class="treeview {{ setMenuActive('admin/sendemails') }}">
        <a href="#">
            <i class="fa fa-envelope-square"></i>
            <span>Thông tin gửi email</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/sendemails/all') }}"><a href="{{url('admin/sendemails/all')}}"><i class="fa fa-child"></i>Gửi tất cả</a></li>
            <li class="{{ setMenuActive('admin/sendemails/members') }}"><a href="{{url('admin/sendemails/members')}}"><i class="fa fa-child"></i>Gửi theo Email thành viên</a></li>
            <li class="{{ setMenuActive('admin/sendemails/registers') }}"><a href="{{url('admin/sendemails/registers')}}"><i class="fa fa-child"></i>Gửi theo Email đăng ký</a></li>
            <li class="{{ setMenuActive('admin/sendemails/listregister') }}"><a href="{{url('admin/sendemails/listregister')}}"><i class="fa fa-child"></i>Danh sách Email đăng ký</a></li>

        </ul>
    </li>
@endcan
@can('feedback_management')
    <li class="treeview {{ setMenuActive('admin/feedback') }}">
        <a href="#">
            <i class="fa fa-question-circle"></i>
            <span>Quản lý góp ý</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setMenuActive('admin/feedback') }}"><a href="{{url('admin/feedback')}}"><i class="fa fa-child"></i>Tất cả phản hồi</a></li>
            <li class="{{ setMenuActive('admin/feedback/status/noreply') }}"><a href="{{url('admin/feedback/status/noreply')}}"><i class="fa fa-child"></i>Chưa trả lời</a></li>
            <li class="{{ setMenuActive('admin/feedback/status/reply') }}"><a href="{{url('admin/feedback/status/reply')}}"><i class="fa fa-child"></i>Đã trả lời</a></li>
        </ul>
    </li>
@endcan