@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý API CRAWLER</h1>
    </section>
        <section class="content">
            <div align="center">
                <a class="btn btn-success btn-md" href="{{url('admin/crawler')}}">
                    <i class="fa fa-list"></i> Danh sách Crawler
                </a>
                <a class="btn btn-success btn-md" href="{{url('admin/cate/crawler')}}">
                    <i class="fa fa-list"></i> Danh sách Crawler
                </a>
                <br style="clear:both;">
                <br style="clear:both;">
            </div>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới Crwaler</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/crawler/create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Nguồn dữ liệu</label>
                                    <input type="text" name="key" class="form-control" id="key">
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Token xác thực</label>
                                        <input type="text" name="token" class="form-control" id="token">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Định dạng dữ liệu</label>
                                        <input type="text" name="formatdata" class="form-control" id="formatdata">
                                    </div>

                                <div class="form-group">
                                    <label for="title">Get Cookies</label>
                                    <input type="text" name="get_cookies" class="form-control" id="get_cookies">
                                </div>

                                <div class="form-group">
                                <label for="title">Cookies ession</label>
                                <input type="number" name="cookies_session" class="form-control" id="cookies_session">
                            </div>
                                <div class="form-group">
                                    <label for="title">Auto Parse</label>
                                    <input type="number" name="autoparse" class="form-control" id="autoparse">
                                </div>
                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                        </div>
                        </div>
                    </form>


            <!-- /.box -->
    </section><!-- /.content -->
@stop
@section('footerscripts')
@endsection