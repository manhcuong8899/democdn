@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý danh mục</h1>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm mới danh mục</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('admin/cate/create/'.$group) }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="title">{{ trans('VNPCMS.forms.labels.catename') }}</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="title">Mã danh mục</label>
                            <input type="text" name="code" class="form-control" id="code">
                        </div>
                        <div class="form-group">
                            <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                        </div>
                        <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Mô tả</label>
                            <textarea class="form-control" id="short" type="text" name="short"/></textarea>
                            @if ($errors->has('short'))
                                <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">{{ trans('VNPCMS.forms.labels.cateparent') }}</label>
                            <select widthclass="form-control" id="parent_id" name="parent_id" class="form-control">
                    @if($parent!=0)
                                    <option value="{{$viewparent->id}}">{{$viewparent->name}}</option>
                                @else
                                                               <option value="0">Danh mục gốc</option>
                     @endif


                                {{cate_parent($data)}}
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="help-block">
												<strong>{{ $errors->first('parent_id') }}</strong>
											</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                            <input type="number" name="order" class="form-control" id="order" value="1" min="1">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer" align="center">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm lại</button>
                    </div>
                </form>
            </div>
        </div>

            <div class="col-md-8">
        <!-- Default box -->
                <form role="form" action="{{ url('admin/cate/order')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách danh mục</h3>
            </div>
            <div class="box-body">
                @can('categories_management')
                <table class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Thư mục cha</th>
                        <th>Mã</th>

                        <th style="width:15%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $listCate as $list )
                        <tr>
                            <td><input class="form-control" value="{{$list->order}}" name="{{'order['.$list->id.']'}}" style="width: 50px"> </td>
                            @if($group!='products')
							<td>
                                @if($list->children->count()!=0)
                                    <b><a href="{{url('admin/cate/'.$group.'?parent='.$list->id)}}" style="text-decoration: none">{{ $list->name}} (<b><font color="#ff0000">{{$list->children->count()}}</font></b>) </a></b>
                                @else
                                    {{ $list->name }} <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/articles/create/'.$group.'?cateurl='.$list->id)}}">
                                        <i class="fa fa-plus text-blue"> Thêm bài viết</i>
                                    </a>
                                @endif
                            </td>
                            @else
                                <td>
                                    @if($list->children->count()!=0)
                                        <b><a href="{{url('admin/cate/'.$group.'?parent='.$list->id)}}" style="text-decoration: none">{{ $list->name}} (<b><font color="#ff0000">{{$list->children->count()}}</font></b>) </a></b>
                                    @else
                                        {{ $list->name }} <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/create/'.$group.'?cateurl='.$list->id)}}">
                                            <i class="fa fa-plus text-blue"> Thêm sản phẩm</i>
                                        </a>
                                    @endif
                                </td>
                                @endif
                            <td>
                                @if($list->parent_id!=0)
                                    <b><a href="{{url('admin/cate/'.$group.'?parent='.$list->parent->parent_id)}}" style="text-decoration: none">{{ $list->parent->name}}</a></b>
                                @else
                                    Danh mục gốc
                                @endif
                            </td>
                            <td>{{ $list->code }}</td>
                            <td>
                                @can('categories_management')
                                <a href="{{url('admin/cate/edit/'.$list->group.'/'.$list->id)}}" data-toggle="tooltip" title="Sửa danh mục" class="btn btn-xs btn-default btn-flat"><i class="fa fa-edit text-blue"></i></a>
                                @endcan
                                @can('categories_management')
                               {{-- <a data-orderurl="{{url('admin/menu/edit/'.$list->group.'/'.$list->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#Addmenu">
                                <i class="fa fa-plus text-blue"></i> Gán menu</a>--}}
                                <button type="button" data-cateid="{{$list->id}}" data-catename="{{$list->name}}" data-catedeleteurl="{{url('admin/cate/delete/'.$list->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmCateDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title='.trans('VNPCMS.forms.titles.delete').'></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center"><button type="submit" class="btn btn-primary">Cập nhật</button> </td>
                    </tr>
                    </tbody>
                </table>
                @endcan
            </div><!-- /.box-body -->
        </div><!-- /.box -->
                    </form>
                </div>
        @can('categories_management')
        <div class="modal fade" tabindex="-1" role="dialog" id="confirmCateDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Xác nhận xóa danh mục</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('VNPCMS.forms.help.areyousure') }}<b><span id="catename"></span></b>?</p>
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
        @endcan
        </div>

        <!---- Modal chuyển trạng thái đơn hàng---->
        <div class="modal fade" tabindex="-1" role="dialog" id="Addmenu">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Gán liên kết cho menu</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'id'=>'FormStatus']) !!}
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="groupmenu" id="groupmenu">
                                        @foreach($groupmenus as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="display: none" id="menus">
                                    <select class="form-control" name="menus[]" multiple="multiple" style="height:200px;" id="renderdata">

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script>
        ckeditor('long');
        ckeditor('short');
    </script>

    <script>

        var btnCust = '';
        $("#images").fileinput({
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
        $('#groupmenu').change(function(){
            var data = $('#groupmenu').val();
            $.ajax({
                url: '{{url('admin/menus')}}/'+data,
                dataType: "html",
                type: "post",
                data: {_method: 'post', _token: '{{csrf_token()}}', data: data}
            }).done(function(jsonData) {
                $("#menus").css("display","block");
                $('#renderdata').html(jsonData);
            }).fail(function(jsonData) {
                alert('error send data');
            });

        });
    </script>

@endsection