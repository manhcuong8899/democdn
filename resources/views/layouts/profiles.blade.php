@extends('layouts.app')

@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>{{ trans('VNPCMS.pages.titles.memberprofile') }}</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('members') }}"><i class="fa fa-users"></i> Thành viên</a></li>
			<li class="active"><a href="#"> {{ $user->username }}</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<a href="{{url('admin/members/show/'.$user->username)}}" > <img class="profile-user-img img-responsive img-circle" src="{{asset('public/images/systems/avatar.png')}}" alt="{{$user->full_name}}"></a>

						<h3 class="profile-username text-center">{{$user->full_name}}</h3>

						<p class="text-muted text-center">{{$user->levels->name}}</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Đăng nhập</b> <a class="pull-right">{{$user->last_login}}</a>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				@if(Auth::user()->hasRole('admin'))
				<div class="box box-primary">
					<div class="box-body box-profile">

						<h3 class="profile-username text-center">Lịch sửa giao dịch</h3>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Tổng đơn hàng:</b> <a href="{{url('admin/members/order/'.$user->email)}}" class="pull-right"><b><font color="#ff0000">{{ $user->orders->count()}}</font> </b></a>
							</li>
							<li class="list-group-item">
								<b>Tổng kiện hàng:</b> <a  href="{{url('admin/members/package/'.$user->email)}}" class="pull-right"><b><font color="#ff0000">{{ $user->packages->count()}}</font> </b></a>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				@endif
				<!-- /.box -->
				<!-- About Me Box -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Thông tin liên hệ</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<strong><i class="fa fa-book margin-r-5"></i> Điện thoại:  </strong><font color="blue"><b>{{$user->profile->phone}}</b></font>

						<hr>
						<strong><i class="fa fa-envelope margin-r-5"></i> Email:  </strong><font color="blue"><b>{{$user->email}}</b></font>

						<hr>

						<strong><i class="fa fa-map-marker margin-r-5"></i>Địa chỉ: </strong><br>{{$user->profile->address}}

						<hr>


						<strong><i class="fa fa-file-text-o margin-r-5"></i> Ghi chú</strong>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
			@yield('profiles')
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
@stop