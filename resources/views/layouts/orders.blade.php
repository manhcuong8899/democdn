<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>VNP CMS</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/dist/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('/dist/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/dist/css/AdminLTE.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ asset('/dist/css/skins/_all-skins.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	<!-- FontAwesome Icon picker -->
	<link rel="stylesheet" href="{{ asset('/dist/css/fontawesome-iconpicker.min.css') }}">
	<!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
	<!-- Custom css -->
	<link rel="stylesheet" href="{{ asset('/dist/css/custom.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/fileinput/css/fileinput.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/select2/select2.min.css') }}">

	<!-- Styles -->
	{{-- <link href="{{ elixir('/css/app.css') }}" rel="stylesheet"> --}}

	<!-- Fonts -->
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->

	<!-- Styles -->
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->

	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/dist/js/jquery-2.1.4.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->
	<script src="{{ asset('/dist/js/bootstrap.min.js') }}"></script>

	<!-- DataTables -->
	<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

	{{-- <script src="{{ elixir('/js/app.js') }}"></script> --}}

	<!-- JavaScripts -->
	<!-- Morris.js charts -->
	<script src="{{ asset('/dist/js/raphael-min.js') }}"></script>
	<script src="{{ asset('/plugins/morris/morris.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap -->
	<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('/plugins/knob/jquery.knob.js') }}"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('/dist/js/moment.min.js') }}"></script>
	<script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('/dist/js/app.min.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('/dist/js/demo.js') }}"></script>
	<!-- FontAwesome Icon Picker for demo purposes -->
	<script src="{{ asset('/dist/js/fontawesome-iconpicker.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>

</head>

<body class="hold-transition skin-blue-light sidebar-mini">
	<div class="wrapper">
		@include('includes.header')
		@include('includes.mainsidebar')
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@include('includes.flash')
			<br>
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Tìm kiếm {{$type->name}}</h3>
					</div>
					<form role="form" action="{{ url('admin/seach/order') }}" method="POST" enctype="multipart/form-data" id="SeachOrderForm">
						{!! csrf_field() !!}
						<div class="box-body">
							<div class="class col-sm-6 col-xs-12">
								<div class="class col-sm-12 col-xs-12">
									<div class="form-group">
										<select class="form-control select2" style="width: 100%;" name="status" id="status">
											@if(isset($nowstatus))
												<option value="{{$nowstatus->id}}">{{$nowstatus->name}}</option>
											@endif
											@foreach($status as $value)
												<option value="{{$value->id}}">{{$value->name}}</option>
											@endforeach
										</select>
									</div>  </div>
								<div class="class col-sm-6 col-xs-6">
									<div class="form-group">
										<label>Từ ngày</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="fromdate" name="fromdate">
										</div>
										<!-- /.input group -->
									</div></div>
								<div class="class col-sm-6 col-xs-6">
									<div class="form-group">
										<label>Đến ngày</label>

										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="todate" name="todate">
										</div>
										<!-- /.input group -->
									</div>
								</div>

							</div>

							<div class="class col-sm-6 col-xs-12">
								<div class="class col-sm-6 col-xs-6">
									<div class="form-group">
										<a class="btn btn-block btn-success btn-sm" id="seach_order">
											<span class="glyphicon glyphicon-search"></span> Tìm kiếm</a>
									</div>
								</div>
							</div>

							<div class="class col-sm-6 col-xs-12">
								<div class="class col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Mã {{$type->name}}</label>
										<input type="hidden" class="form-control" name="type" id="type" value="{{$type->id}}">
										<input type="text" class="form-control" name="code" id="code" placeholder="Nhập mã {{$type->name}}">
									</div>
								</div>

							</div>

						</div>
					</form>
				</div>
			</div>
			@yield('content')
		</div><!-- /.content-wrapper -->
		@include('includes.footer')
	</div><!-- ./wrapper -->

	<!---- Modal chuyển trạng thái đơn hàng---->
	<div class="modal fade" tabindex="-1" role="dialog" id="StatusDialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Chuyển trạng thái {{$type->name}}</h4>
				</div>
				{!! Form::open(['method' => 'POST', 'id'=>'FormStatusOrder']) !!}
				{!! csrf_field() !!}
				<div class="modal-body">
					<div class="box-body">
						<div class="col-md-12">
							<div class="form-group">
								<select class="form-control" name="status">
									@foreach($status as $value)
										<option value="{{$value->id}}">{{$value->name}}</option>
									@endforeach
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
	<!-- Custom scripts -->
	<script src="{{ asset('/dist/js/custom.js') }}">
	</script>
	<script>
		//Date picker
		$('#todate').datepicker({
			autoclose: true,
			format:'yyyy-mm-dd',
			language: 'vn'
		});
		$('#fromdate').datepicker({
			autoclose: true,
			format:'yyyy-mm-dd',
			language: 'vn'
		});
	</script>
	<script>
		$(".select2").select2();
	</script>
	@yield('footerscripts')
</body>
</html>
