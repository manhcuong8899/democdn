@extends('themes.articles')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <h2 class="pageTitle lTitle">Điều khoản sử dụng</h2>
        <div class="page-detail">
            <div class="row">
           {!!$settings['useterms']!!}
        </div><!-- /.page-detail -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection