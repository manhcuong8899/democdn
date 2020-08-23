@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý Danh sách Email đăng ký nhận thông tin</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tìm kiếm hình ảnh</h3>
            </div>
            <form role="form" action="{{ url('admin/registeremails/seach') }}" method="GET" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <select class="form-control" name="status" id="status">
                                <option value="-1">Tất cả</option>
                                <option value="1">Đã kích hoạt</option>
                                <option value="0">Chưa kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-md-3"> <button type="submit" class="btn btn-primary">Tìm kiếm</button> <button type="button" class="btn btn-success" id="exportExcel">Kết xuất</button></div>
                        <div class="col-md-2"> </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <div class="row">
            <!-- /.box -->
            <div class="col-md-12">
                <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Danh sách Emails</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Địa chỉ email</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listemail as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->email}}</td>
                                            <td>  {{$value->created_at}}</td>
                                            <td>
                                                    @if($value->status=='1')
                                                        Đã kích hoạt
                                                    @else
                                                       Chưa kích hoạt
                                                    @endif

                                               </td>
                                            <td>
                                                <a data-title="Xác nhận xóa địa chỉ email!" data-body="Bạn có chắc chắn xóa địa chỉ email?" href="{{ url('admin/registeremails/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
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
    <script type="text/javascript">
        $('#exportExcel').click(function(){
            var status = $('#status').val();
            var url =  '{{url('admin/sendemails/exportemail')}}/'+status;
            window.location = url;
        });
    </script>


@endsection