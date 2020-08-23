@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý thông tin gửi email</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới nội dung gửi email</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/sendemails/edit/'.$info->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title"  value="{{$info->title}}" required/>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
												<strong>{{ $errors->first('title') }}</strong>
											</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Hình thức gửi</label>
                                    <select class="form-control" name="formsend" id="formsend">
                                        <option value="{{$info->formsend}}">Lựa chọn hình thức gửi</option>
                                        <option value="1">Cố định 1 lần</option>
                                        <option value="2" >Trong khoảng thời gian</option>
                                        <option value="3" >Hàng ngày</option>
                                    </select>
                                </div>
                            </div>
                            @if($info->formsend==1 || $info->formsend==2)
                                <div class="col-md-6" id="startdate">
                                    <div class="form-group">
                                        <label for="title">Thời gian gửi</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="fromdate" name="start_date" value="{{$info->start_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="startdate" style="display: none">
                                    <div class="form-group">
                                        <label for="title">Thời gian gửi</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="fromdate" name="start_date" value="{{$info->start_date}}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6" id="startdate" style="display: none">
                                    <div class="form-group">
                                        <label for="title">Thời gian gửi</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="fromdate" name="start_date">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($info->formsend==2)
                                <div class="col-md-6" id="enddate">
                                    <div class="form-group">
                                        <label for="title">Thời gian kết thúc</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="todate" name="end_date" value="{{$info->end_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="enddate" style="display: none">
                                    <div class="form-group">
                                        <label for="title">Thời gian kết thúc</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="todate" name="end_date" value="{{$info->end_date}}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6" id="enddate" style="display: none">
                                    <div class="form-group">
                                        <label for="title">Thời gian kết thúc</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="todate" name="end_date">
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Nội dung</label>
                                    <textarea class="form-control" id="content" type="text" name="content" rows="9"/>{{$info->content}}</textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="col-md-12" align="center">
                                <button type="submit" class="btn btn-primary" id="submit">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
            <div class="col-md-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Danh sách thông báo</b></h3>
                    </div>
                    <div class="box-body">

                        <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tiêu đề thông báo</th>
                                <th>Hình thức</th>
                                <th>Bắt đầu gửi</th>
                                <th>Kết thúc gửi</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $key=>$value)
                                <tr>
                                    <td><b> {{$key+1}}</b></td>
                                    <td>  {{$value->title}}</td>
                                    <td>
                                        @if($value->formsend=='1')
                                            Cố định 1 lần
                                        @endif
                                        @if($value->formsend=='2')
                                            Khoảng thời gian
                                        @endif
                                        @if($value->formsend=='3')
                                            Hàng ngày
                                        @endif
                                    </td>

                                    <td>
                                        @if($value->formsend=='1' || $value->formsend=='2')
                                            {{date($value->start_date)}}
                                        @else
                                            {{date($value->created_at)}}
                                        @endif

                                    </td>
                                    <td>
                                        @if($value->formsend=='2')
                                            {{date($value->end_date)}}
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/sendemails/edit/'.$value->id)}}">
                                            <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                        </a>
                                        <a data-title="Xác nhận xóa thông báo!" data-body="Bạn có chắc chắn xóa thông báo?" href="{{ url('admin/sendemails/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>
        </div>

    </section><!-- /.content -->
@endsection
@section('footerscripts')
    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('content');
        };
        $('#formsend').change(function(){
            var form = $('#formsend').val();
            if(form!="0"){
                $("#submit").css("display","block");
            }
            if(form=="0"){
                $("#submit").css("display","none");
            }
            if(form=="1")
            {
                $("#startdate").css("display","block");
                $("#enddate").css("display","none");
            }
            if(form=="2"){
                $("#startdate").css("display","block");
                $("#enddate").css("display","block");
            }
            if(form=="3"){
                $("#startdate").css("display","none");
                $("#enddate").css("display","none");
            }

        });
    </script>
@endsection