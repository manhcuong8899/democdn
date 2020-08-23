@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('VNPCMS.pages.titles.'.$group) }}</h1>
    </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.editcate') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/cate/update/'.$group.'/'.$cate->id) }}" method="POST" enctype="multipart/form-data">
                        {!! method_field('PATCH') !!}
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.catename') }}</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$cate->name}}">
                            </div>
                            @if($cate->images!="")
                            <div class="form-group">
                                <img src="{{asset('public/images/categories/'.$cate->group.'/'.$cate->images)}}" width="120">
                            </div>
                            @endif
                            <div class="form-group">
                                <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="title">Mã danh mục</label>
                                <input type="text" name="code" class="form-control" id="code" value="{{$cate->code}}">
                            </div>
                            <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">{{ trans('VNPCMS.forms.labels.short') }}</label>
                                <textarea class="form-control" id="short" type="text" name="short"/> {{$cate->short}}</textarea>
                                @if ($errors->has('short'))
                                    <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                @endif
                            </div>
                                <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : ' has-feedback' }}">
                                    <label for="title">{{ trans('VNPCMS.forms.labels.cateparent') }}</label>
                                    <select widthclass="form-control" id="parent_id" name="parent_id" class="form-control">
                                        @if($cate->hasParent())
                                        <option value="{{$cate->parent_id}}">{{$cate->parent->name}}</option>
                                        @else
                                            <option value="0">Danh mục gốc</option>
                                        @endif
                                          {{cate_parent($data,0,"--",$cate->parent_id)}}
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <span class="help-block">
												<strong>{{ $errors->first('parent_id') }}</strong>
											</span>
                                    @endif
                                </div>

                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="cate_order" class="form-control" id="cate_order" value="1" min="1">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Phục hồi</button>
                        </div>
                    </form>
                </div>
                </div>
            <!-- /.box -->
            <!-- Default box -->
                <div class="col-md-8">
                    <!-- Default box -->
                    <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.listcate'.$group) }}</h3>
                </div>
                <div class="box-body">
                    @can('categories_management')
                  <table class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
						 <th>#ID</th>
                        <th>Tên danh mục</th>
                        @if($group=='products')
                            <th>Trung Quốc</th>
                        @endif
                        <th>Parent</th>
                        <th>Mã</th>

                        <th style="width:15%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $listCate as $list )
                        <tr>
                            <td><input class="form-control" value="{{$list->order}}" name="{{'order['.$list->id.']'}}" style="width: 50px"> </td>
                            <td>
                                   <b>{{ $list->id }}</b> 
                            </td>
							<td>
                                @if($list->children->count()!=0)
                                    <b><a href="{{url('admin/cate/'.$group.'?parent='.$list->id)}}" style="text-decoration: none">{{ $list->name}} (<b><font color="#ff0000">{{$list->children->count()}}</font></b>) </a></b>
                                @else
                                    {{ $list->name }}
                                @endif
                            </td>
                            @if($group=='products')
                                <td>
                                    {{ $list->china }}
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
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
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
@endsection