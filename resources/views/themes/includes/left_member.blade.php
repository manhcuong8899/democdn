<div class="acc-left">
    <h3 class="ch4_title text-uppercase">Danh mục</h3>
    <ul class="list-unstyled">
        <li @if($url=='show')class="active"@endif><a href="{{url('members/show')}}"><i class="fa fa-cog"></i> Thông tin tài khoản</a></li>
        <li @if($url=='orders')class="active"@endif><a href="{{url('members/orders')}}"><i class="fa fa-home"></i> Lịch sử giao dịch</a></li>
    </ul>
</div>