@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- <div class="col-md-10 col-md-offset-1"> -->
		<div class="col-md-12" style="margin-bottom:20px;">
			<h1>
				Bảng điều khiển
				<small>Quản trị website</small>
			</h1>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>{{$Totaluser}}</h3>
					<p>Tài khoản</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="{{url('admin/users')}}" class="small-box-footer">Hiển thị <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>{{$Totalnews}}</h3>
					<p>Tin tức</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{url('admin/articles/news')}}" class="small-box-footer">Hiển thị<i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>{{$Totalservices}}</h3>
					<p>Dịch vụ</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="{{url('admin/articles/services')}}" class="small-box-footer">Hiển thị <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>{{$Totalproducts}}</h3>
					<p>Sản phẩm</p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a href="{{url('admin/products')}}" class="small-box-footer">Hiển thị<i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
	</div><!-- /.row -->
	<!-- Main row -->
</section>
@endsection
