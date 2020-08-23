@extends('layouts.articles')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý nội dung {{$type->name}}</h1>
    </section>
    <section class="content">
            <div class="box">
                <form role="form" action="{{ url('admin/articles/seach/'.$group) }}" method="GET" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Danh mục {{$type->name}}</label>
                                <select class="form-control select2" name="categories" style="width: 100%;">
                                    <option value="0">Tất cả</option>
                                    <?php function_add($cates); ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="title">Tìm kiếm theo tiêu đề</label>
                                <input type="text" name="nameseach" class="form-control" placeholder="Nhập tiêu đề nội dung cần tìm kiếm">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer" align="center">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>

        <!-- Default box -->
        <form role="form" action="{{ url('admin/articles/order')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
        <div class="box">
            <div class="box-body">
                @can('info_management')
                <a class="btn btn-success btn-md" href="{{url('admin/articles/create/'.$group)}}">
                    <i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
                </a>
                @endcan
                <br style="clear:both;">
                <br style="clear:both;">
                @can('info_management')
                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề nội dung</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Slug</th>
                        @can('info_management')
                        <th>Thao tác</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article )
                        <tr>
                            <td><input class="form-control" value="{{$article->order}}" name="{{'order['.$article->id.']'}}" style="width: 50px"> </td>
                            <td>{{ $article->name }}</td>
                            <td>{{ $article->cates->name }}</td>
                            </td>
                            <td>@if($article->status==1)
                            Hiển thị
                            @else
                            Ẩn @endif</td>
                            <td>{{ $article->slug}}</td>
                            <td>
                            @can('info_management')
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/articles/'.$group.'/edit/'.$article->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>
                            @endcan
                            @can('info_management')
                                <button type="button" data-articleid="{{ $article->id }}" data-articlename="{{$article->name}}" data-articledeleteurl="{{ url('admin/articles/delete/'.$article->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmArticlesDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
                            @endcan</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" align="center"><button type="submit" class="btn btn-primary">Cập nhật</button> </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pull-right">
                    <ul class="pagination">
                        {!! $articles->render() !!}
                    </ul>
                </div>
                @endcan
            </div><!-- /.box-body -->
        </div><!-- /.box -->
            </form>
        @can('info_management')
        <div class="modal fade" tabindex="-1" role="dialog" id="confirmArticlesDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmnewsdeletion') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="articlename"></span></b>?</p>
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
    </section><!-- /.content -->
@stop