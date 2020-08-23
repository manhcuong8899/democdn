@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Cấu hình chi phí</h1>
</section>

<section class="content">
	<form role="form" action="{{ url('/admin/settings/general') }}" method="POST">
		{!! method_field('PATCH') !!}
		{!! csrf_field() !!}
	<div class="row">
		<div class="col-md-6">
			<!--- Cau hinh chi phi--->
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">Phí kiểm đếm trên đơn vị 1 sản phẩm</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<label for="crmname">Dưới 30 ngày:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('countproduct-1') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="countproduct-1" name="countproduct-1"  value="{{ old('countproduct-1') ? old('countproduct-1') : $settings['countproduct-1'] }}" required/>
										@if ($errors->has('countproduct-1'))
											<span class="help-block">
												<strong>{{ $errors->first('countproduct-1') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Quá 30 ngày:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('countproduct-30') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="countproduct-30" name="countproduct-30"  value="{{ old('countproduct-30') ? old('countproduct-30') : $settings['countproduct-30'] }}" required/>
										@if ($errors->has('countproduct-30'))
											<span class="help-block">
												<strong>{{ $errors->first('countproduct-30') }}</strong>
											</span>
										@endif
									</div>
								</div>

							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>

			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">Phí đặt hàng</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<label for="crmname">% đặt cọc</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('deposit') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="deposit" name="deposit"  value="{{ old('deposit') ? old('deposit') : $settings['deposit'] }}" required/>
										@if ($errors->has('deposit'))
											<span class="help-block">
												<strong>{{ $errors->first('deposit') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<label for="crmname">% Phí mua hộ/tổng giá trị đơn hàng</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('purchasefee') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="purchasefee" name="purchasefee"  value="{{ old('purchasefee') ? old('purchasefee') : $settings['purchasefee'] }}" required/>
										@if ($errors->has('purchasefee'))
											<span class="help-block">
												<strong>{{ $errors->first('purchasefee') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<label for="crmname">Bảo hiểm:(%)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('insurrance') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="insurrance" name="insurrance"  value="{{ old('insurrance') ? old('insurrance') : $settings['insurrance'] }}" required/>
										@if ($errors->has('insurrance'))
											<span class="help-block">
												<strong>{{ $errors->first('insurrance') }}</strong>
											</span>
										@endif
									</div>
								</div>

							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
			<!--- ket thuc--->

			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">Phí vận chuyển /1000g:(đ)</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<label for="crmname">Trung Quốc - Việt Nam</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('transportTQ-VN') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="transportTQ-VN" name="transportTQ-VN"  value="{{ old('transportTQ-VN') ? old('transportTQ-VN') : $settings['transportTQ-VN'] }}" required/>
										@if ($errors->has('transportTQ-VN'))
											<span class="help-block">
												<strong>{{ $errors->first('transportTQ-VN') }}</strong>
											</span>
										@endif
									</div>
								</div>


								<div class="col-md-4">
									<label for="crmname">Nhật Bản - Việt Nam</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('transportJP-VN') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="transportJP-VN" name="transportJP-VN"  value="{{ old('transportJP-VN') ? old('transportJP-VN') : $settings['transportJP-VN'] }}" required/>
										@if ($errors->has('transportJP-VN'))
											<span class="help-block">
												<strong>{{ $errors->first('transportJP-VN') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Mỹ - Việt Nam</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('transportUS-VN') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="transportUS-VN" name="transportUS-VN"  value="{{ old('transportUS-VN') ? old('transportUS-VN') : $settings['transportUS-VN'] }}" required/>
										@if ($errors->has('transportUS-VN'))
											<span class="help-block">
												<strong>{{ $errors->first('transportUS-VN') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Hàn - Việt Nam</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('transportKR-VN') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="transportKR-VN" name="transportKR-VN"  value="{{ old('transportKR-VN') ? old('transportKR-VN') : $settings['transportKR-VN'] }}" required/>
										@if ($errors->has('transportKR-VN'))
											<span class="help-block">
												<strong>{{ $errors->first('transportKR-VN') }}</strong>
											</span>
										@endif
									</div>
								</div>

							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
			<!--- ket thuc--->
		</div>

		<div class="col-md-6">
			<!--- Cau hinh chi phi đóng thùng gỗ--->
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">Phí đóng thùng</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<label for="crmname">Kích cỡ 0-90cm:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('size90') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="size90" name="size90"  value="{{ old('size90') ? old('size90') : $settings['size90'] }}" required/>
										@if ($errors->has('size90'))
											<span class="help-block">
												<strong>{{ $errors->first('size90') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Kích cỡ 90-120cm:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('size120') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="size120" name="size120"  value="{{ old('size120') ? old('size120') : $settings['size120'] }}" required/>
										@if ($errors->has('size120'))
											<span class="help-block">
												<strong>{{ $errors->first('size120') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Kích cỡ 120-160cm:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('size160') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="size160" name="size160"  value="{{ old('size160') ? old('size160') : $settings['size160'] }}" required/>
										@if ($errors->has('size160'))
											<span class="help-block">
												<strong>{{ $errors->first('size160') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Thùng gỗ ballet Ship Nhật:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('JPballet') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="JPballet" name="JPballet"  value="{{ old('JPballet') ? old('JPballet') : $settings['JPballet'] }}" required/>
										@if ($errors->has('JPballet'))
											<span class="help-block">
												<strong>{{ $errors->first('JPballet') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Thùng gỗ ballet Ship Hàn:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('KRballet') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="KRballet" name="KRballet"  value="{{ old('KRballet') ? old('KRballet') : $settings['KRballet'] }}" required/>
										@if ($errors->has('KRballet'))
											<span class="help-block">
												<strong>{{ $errors->first('KRballet') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<label for="crmname">Thùng gỗ ballet Ship Mỹ:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('AMballet') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="AMballet" name="AMballet"  value="{{ old('AMballet') ? old('AMballet') : $settings['AMballet'] }}" required/>
										@if ($errors->has('AMballet'))
											<span class="help-block">
												<strong>{{ $errors->first('AMballet') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Thùng gỗ ballet Ship Trung Quốc:(đ)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('CNballet') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="CNballet" name="CNballet"  value="{{ old('CNballet') ? old('CNballet') : $settings['CNballet'] }}" required/>
										@if ($errors->has('CNballet'))
											<span class="help-block">
												<strong>{{ $errors->first('CNballet') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
<!--- Cấu hình tăng cấp độ thành viên -->
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">Điều kiện thành viên</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<label for="crmname">Thành viên vàng:(triệu đồng)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('gold') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="gold" name="gold"  value="{{ old('gold') ? old('gold') : $settings['gold'] }}" required/>
										@if ($errors->has('gold'))
											<span class="help-block">
												<strong>{{ $errors->first('gold') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Thành viên bạc:(triệu đồng)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('sliver') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="sliver" name="sliver"  value="{{ old('sliver') ? old('sliver') : $settings['sliver'] }}" required/>
										@if ($errors->has('sliver'))
											<span class="help-block">
												<strong>{{ $errors->first('sliver') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="col-md-4">
									<label for="crmname">Thành viên đồng:(triệu đồng)</label>
								</div>
								<div class="col-md-8">
									<div class="form-group {{ $errors->has('bronze') ? ' has-error' : ' has-feedback' }}">
										<input type="text" class="form-control" id="bronze" name="bronze"  value="{{ old('bronze') ? old('bronze') : $settings['bronze'] }}" required/>
										@if ($errors->has('bronze'))
											<span class="help-block">
												<strong>{{ $errors->first('bronze') }}</strong>
											</span>
										@endif
									</div>
								</div>


							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</div>

	</div>
		<div  align="center">
				<button type="submit" class="btn btn-primary">Cập nhật</button>
		</div>
	</form>
</section>
<!-- iCheck -->
<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
<script>
	//iCheck for checkbox and radio inputs
	// $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	//   checkboxClass: 'icheckbox_minimal-blue',
	//   radioClass: 'iradio_minimal-blue'
	// });
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});
</script>
@stop