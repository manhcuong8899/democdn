@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý Cấu hình API CRAWLER</h1>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới CRAWLER</h3>
            </div>
            <form role="form" action="{{ url('admin/crawler/create') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                        <div class="form-group">
                            <label for="title">Dữ liệu</label>
                            <input type="text" name="key" class="form-control" id="key">
                        </div>
                    <div class="form-group">
                        <label for="title">Scraper</label>
                        <input type="text" name="scraper" class="form-control" id="scraper">
                    </div>


                        <div>
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
                            <input type="text" name="cookies_session" class="form-control" id="cookies_session">
                        </div>
                        <div class="form-group">
                            <label for="title">Auto Parse</label>
                            <input type="text" name="autoparse" class="form-control" id="autoparse">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>

                </div>
            </form>

        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách CRAWLER</h3>
            </div>
            <div class="box-body">
                <br style="clear:both;">
                <br style="clear:both;">

                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Dữ liệu</th>
                        <th>Scraper</th>
                        <th>Token</th>
                        <th>Format</th>
                        <th>Cookies_session</th>
                        <th>Get_cookies</th>
                        <th>Autoparse</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $crawler as $acrawl )
                        <tr>
                            <td>{{ $acrawl->key }}</td>
                            <td>{{ $acrawl->scraper }}</td>
                            <td>{{ $acrawl->token }}</td>
                            <td>{{ $acrawl->formatdata }}</td>
                            <td>{{ $acrawl->get_cookies }}</td>
                            <td>{{ $acrawl->cookies_session }}</td>
                            <td>{{ $acrawl->autoparse }}</td>
                            <td>
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/crawler/edit/'.$acrawl->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>
                                <a data-title="Xác nhận xóa Crawler!" data-body="Bạn có chắc chắn xóa Crawler?" href="{{ url('admin/crawler/delete/'.$acrawl->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmproductsdeletion') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="productname"></span></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
                        {!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('VNPCMS.forms.buttons.delete') }}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </section><!-- /.content -->
@stop