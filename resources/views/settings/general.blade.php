@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><b>Cấu hình thông tin chung Website</b></h1>
</section>

<section class="content">
	<form role="form" action="{{ url('/admin/settings/general') }}" method="POST" enctype="multipart/form-data">
		{!! method_field('PATCH') !!}
		{!! csrf_field() !!}
		<div class="row">
			<!--- Panel setting Fontend--->
			<div class="col-md-12">
				<!--- ket thuc--->
				<div class="box box-default col-md-12">
					<div class="row">
						<div class="col-md-12 pull-left">
							<div class="box-body">
								<div class="row">

									<div class="col-md-2">
										<label for="crmfooter">Chính sách Thanh toán*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('thanhtoan') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="thanhtoan" type="text" name="thanhtoan" required rows="6"/>{{ old('thanhtoan') ? old('thanhtoan') : $settings['thanhtoan'] }}</textarea>
											@if ($errors->has('thanhtoan'))
												<span class="help-block">
												<strong>{{ $errors->first('thanhtoan') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="crmfooter">Chính sách vận chuyển*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('vanchuyen') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="vanchuyen" type="text" name="vanchuyen" required rows="6"/>{{ old('vanchuyen') ? old('vanchuyen') : $settings['vanchuyen'] }}</textarea>
											@if ($errors->has('vanchuyen'))
												<span class="help-block">
												<strong>{{ $errors->first('vanchuyen') }}</strong>
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

	<div class="row">
		<!--- Panel setting Fontend--->
		<div class="col-md-12">
			<!--- ket thuc--->
			<div class="box box-default col-md-12">
				<div class="box-header with-border">
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
							<div class="box-body">
								<div class="row">

									<div class="col-md-2">
										<label for="crmname">{{ trans('VNPCMS.forms.labels.titlehomepage') }}*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('crmname') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="crmname" name="titlehomepage"  value="{{ old('titlehomepage') ? old('titlehomepage') : $settings['titlehomepage'] }}" required/>
											@if ($errors->has('titlehomepage'))
												<span class="help-block">
												<strong>{{ $errors->first('titlehomepage') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-2">
										<label for="crmname">Logo*</label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<img src="{{asset('public/images/logo/'.$settings['images'])}}" width="120">
									</div>	</div>
									<div class="col-md-2">
										<label for="crmname"></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input type="file" id="images" name="images" class="file-loading" accept="image/*">
									</div>
									</div>

									<div class="col-md-2">
										<label for="url">Thẻ keywords*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('keywords') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="keywords" type="text" name="keywords" rows="3"/>{{ old('keywords') ? old('keywords') : $settings['keywords'] }}</textarea>
											@if ($errors->has('keywords'))
												<span class="help-block">
												<strong>{{ $errors->first('keywords') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="url">Thẻ description*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="description" type="text" name="description" rows="5"/>{{ old('description') ? old('description') : $settings['description'] }}</textarea>
											@if ($errors->has('description'))
												<span class="help-block">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-2">
										<label for="orgname">Mã màu nền menu</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('backgroudmenu') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="backgroudmenu" name="backgroudmenu" value="{{ old('backgroudmenu') ? old('backgroudmenu') : $settings['backgroudmenu'] }}" required/>
											@if ($errors->has('backgroudmenu'))
												<span class="help-block">
												<strong>{{ $errors->first('backgroudmenu') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="orgname">Mã màu chữ menu</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('fontcolormenu') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="backgroudmenu" name="fontcolormenu" value="{{ old('fontcolormenu') ? old('fontcolormenu') : $settings['fontcolormenu'] }}" required/>
											@if ($errors->has('fontcolormenu'))
												<span class="help-block">
												<strong>{{ $errors->first('fontcolormenu') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="crmdescription">Trụ sở chính</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('address') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="address" name="address" placeholder="{{ trans('VNPCMS.forms.placeholders.address') }}" value="{{ old('address') ? old('address') : $settings['address'] }}" required>
											@if ($errors->has('address'))
												<span class="help-block">
												<strong>{{ $errors->first('address') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="orgname">Địa chỉ email*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('orgname') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : $settings['email'] }}" required/>
											@if ($errors->has('email'))
												<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
											@endif
										</div>
									</div>


									<div class="col-md-2">
										<label for="orgdescription">Di động</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ? old('phone') : $settings['phone'] }}"/>
											@if ($errors->has('phone'))
												<span class="help-block">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
											@endif
										</div>
									</div>


									<div class="col-md-2">
										<label for="address">Hỗ trợ trực tuyến</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('hotline') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="hotline" type="text" name="hotline"/>{{ old('hotline') ? old('hotline') : $settings['hotline'] }}</textarea>
											@if ($errors->has('hotline'))
												<span class="help-block">
												<strong>{{ $errors->first('hotline') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="address">Skype</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('skype') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="skype" name="skype" value="{{ old('skype') ? old('skype') : $settings['skype'] }}"/>

										@if ($errors->has('skype'))
												<span class="help-block">
												<strong>{{ $errors->first('skype') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="url">{{ trans('VNPCMS.forms.labels.linkfanpage') }}*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('linkfanpage') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="linkfanpage" placeholder="http://www.example.com/" type="text" name="linkfanpage"  value="{{ old('linkfanpage') ? old('linkfanpage') : $settings['linkfanpage'] }}"/>
											@if ($errors->has('linkfanpage'))
												<span class="help-block">
												<strong>{{ $errors->first('linkfanpage') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="url">Chat Facebook*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('chatfacebook') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="chatfacebook" placeholder="" type="text" name="chatfacebook"  value="{{ old('chatfacebook') ? old('chatfacebook') : $settings['chatfacebook'] }}"/>
											@if ($errors->has('chatfacebook'))
												<span class="help-block">
												<strong>{{ $errors->first('chatfacebook') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-2">
										<label for="url">MessengerFacebook*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('messengerfacebook') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="messengerfacebook" placeholder="" type="text" name="messengerfacebook"  value="{{ old('messengerfacebook') ? old('chatfacebook') : $settings['messengerfacebook'] }}"/>
											@if ($errors->has('messengerfacebook'))
												<span class="help-block">
												<strong>{{ $errors->first('messengerfacebook') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="url">{{ trans('VNPCMS.forms.labels.linkgoogle') }}*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('linkgoogle') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="linkgoogle" placeholder="http://www.example.com/" type="text" name="linkgoogle"  value="{{ old('linkfanpage') ? old('linkfanpage') : $settings['linkfanpage'] }}"/>
											@if ($errors->has('linkgoogle'))
												<span class="help-block">
												<strong>{{ $errors->first('linkgoogle') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-2">
										<label for="url">Bản đồ*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('googlemap') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="googlemap" type="text" name="googlemap" rows="6"/>{{ old('googlemap') ? old('googlemap') : $settings['googlemap'] }}</textarea>
											@if ($errors->has('googlemap'))
												<span class="help-block">
												<strong>{{ $errors->first('googlemap') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="url">Thời gian làm việc*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('time') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="time" type="text" name="time"  value="{{ old('time') ? old('time') : $settings['time'] }}"/>
											@if ($errors->has('time'))
												<span class="help-block">
												<strong>{{ $errors->first('time') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-2">
										<label for="crmfooter">{{ trans('VNPCMS.forms.labels.footer') }}*</label>
									</div>
									<div class="col-md-10">
										<div class="form-group {{ $errors->has('footer') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="footer" type="text" name="footer" required rows="6"/>{{ old('footer') ? old('footer') : $settings['footer'] }}</textarea>
											@if ($errors->has('footer'))
												<span class="help-block">
												<strong>{{ $errors->first('footer') }}</strong>
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

				<button type="submit" class="btn btn-primary">{{ trans('VNPCMS.forms.buttons.update') }}</button>

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
<script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
<script>
    ckeditor('vanchuyen');
    ckeditor('thanhtoan');
</script>

<script>
	var btnCust = '';
	$("#images").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		browseLabel: ' &nbsp;&nbsp;Tải ảnh',
		browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-avatar-errors-1',
		msgErrorClass: 'alert alert-block alert-danger',

		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "png", "gif","png"]
	});
</script>
@stop