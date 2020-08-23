@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('VNPCMS.pages.titles.'.$group) }}</h1>
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.list'.$group) }}</h3>
            </div>
            <div class="box-body">
                @can('articles_create')
                <a class="btn btn-success btn-md" href="{{url('admin/articles/create/'.$group)}}">
                    <i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
                </a>
                @endcan
                <br style="clear:both;">
                <br style="clear:both;">
                @can('articles_view')
                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.title') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.catename') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.status') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.createdat') }}</th>
                        @can('articles_update')
                        <th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $articles as $article )
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->name }}</td>
                            <td><?php
                                $p = $article->cate_id;
                                $json = json_decode($p);
                                if (count($json) > 0) {
                                    foreach ($json as $value) {
                                        $data = \Illuminate\Support\Facades\DB::table('cate_article')->where('id',$value)->first();
                                        if ($data) {
                                            echo '<span class="phaynone">,</span>' . $data->name;
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>{{ $article->status }}</td>
                            <td>{{ $article->created_at}}</td>
                            <td>
                            @can('articles_update')
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/articles/'.$group.'/edit/'.$article->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>
                            @endcan
                            @can('articles_delete')
                                <button type="button" data-articleid="{{ $article->id }}" data-articlename="{{$article->name}}" data-articledeleteurl="{{ url('admin/articles/delete/'.$article->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmArticlesDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
                            @endcan</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.title') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.catename') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.status') }}</th>
                        <th>{{ trans('VNPCMS.forms.tables.columns.createdat') }}</th>
                        @can('articles_updated')
                        <th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
                        @endcan
                    </tr>
                    </tfoot>
                </table>
                @endcan
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        @can('articles_delete')
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