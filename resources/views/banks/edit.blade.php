@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý ngân hàng</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa tài khoản ngân hàng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/banks/edit/'.$bank->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="title">Ngân hàng</label>
                                    <select class="form-control" name="categories">
                                        <option value="{{$bank->cate_id}}">{{$bank->cates->name}}</option>
                                        @foreach($cates as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Số tài khoản</label>
                                        <input type="text" name="banknumber" class="form-control" id="banknumber" value="{{$bank->banknumber}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Tên tài khoản</label>
                                        <input type="text" name="accountbank" class="form-control" id="accountbank" value="{{$bank->accountbank}}">
                                    </div>

                                <div class="form-group">
                                    <label for="title">Chi nhánh</label>
                                    <input type="text" name="branch" class="form-control" id="branch" value="{{$bank->branch}}">
                                </div>

                                <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" value="{{$bank->order}}" min="1">
                            </div>

                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm lại</button>
                        </div>
                        </div>
                        </div>
                    </form>
                </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Danh sách tài khoản</h3>
                        </div>
                        <div class="box-body">
                            <br style="clear:both;">
                            <br style="clear:both;">

                            <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Số tài khoản</th>
                                    <th>Tên tài khoản</th>
                                    <th>Chi nhánh</th>
                                    <th>Ngân hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $banks as $bank )
                                    <tr>
                                        <td>{{ $bank->banknumber }}</td>
                                        <td>{{ $bank->accountbank }}</td>
                                        <td>{{ $bank->branch }}</td>
                                        <td>{{ $bank->cates->name }}</td>
                                        <td>
                                            @if($bank->status==1)
                                                Sử dụng
                                            @else
                                                Ngừng sử dụng
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/banks/edit/'.$bank->id)}}">
                                                <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                            </a>

                                            <a data-title="Xác nhận xóa ngân hàng!" data-body="Bạn có chắc chắn xóa ngân hàng?" href="{{ url('admin/banks/delete/'.$bank->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                            {{--   <button type="button" data-Banksid="{{ $product->id }}" data-Banksname="{{$product->name}}" data-Banksdeleteurl="{{ url('admin/Banks/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>--}}
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

            <!-- /.box -->
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>

    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

    <script>

        var btnCust = '';
        $("#Banks").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',

            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>

    <script>
        $("#input-image").fileinput({
            uploadUrl: "{{url('Banks/articles/')}}",
            uploadAsync: true,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>
@endsection