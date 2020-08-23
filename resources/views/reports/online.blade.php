@extends('layouts.app')
@section('content')
<section class="content-header">
    <h1>Quản lý mua hàng Online</h1>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box box-primary">
        <form role="form" action="{{ url('admin/report/orderexcel') }}" method="POST" id="ReportOrderForm">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="class col-sm-12 col-xs-12">
                    <div class="class col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label>Từ ngày</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="fromdate" value="{{date('Y-m-d H:i:s', strtotime($fromdate)) }}" name="fromdate">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="class col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label>Đến ngày</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="todate" value="{{date('Y-m-d H:i:s', strtotime($todate)) }}" name="todate">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Trạng thái đơn hàng</label><br />
                            {!! Form::select('status', ['' => 'Please Select']+$status, old('status'), ['class' => 'form-control select2', 'id' => 'status'])  !!}
                        </div>
                    </div>
                    <div class="class col-sm-2 col-xs-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="input-group date">
								<input type="submit" value="Kết xuất" class="form-submit btn btn-primary">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section><!-- /.content -->
@stop
@section('footerscripts')
@endsection