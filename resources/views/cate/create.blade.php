@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('VNPCMS.pages.titles.'.$group) }}</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.addcate') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/cate/create/'.$group) }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.catename') }}</label>
                                <input type="text" name="name" class="form-control" id="name">
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
                                        <option value="">Danh mục gốc</option>
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

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Chấp nhận</button>
                        </div>
                    </form>
                </div>

            <!-- /.box -->

    </section><!-- /.content -->
@stop