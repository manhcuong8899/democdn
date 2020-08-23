@extends('layouts.app')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Quản lý khách hàng</h1>
</section>

<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Danh sách khách hàng</h3>
		</div>
		<div class="box-body">
			<a href="{{url('admin/exportcustomer/'.$level)}}"><button type="button" class="btn btn-success" id="exportExcel">Kết xuất</button> </a>
			{{--@can('customer_management')
				<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewuser">
					<i class="fa fa-plus"></i> Thêm khách hàng
				</a>
			@endcan--}}
			<br style="clear:both;">
			<br style="clear:both;">
			@can('customer_management')
				<table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>STT</th>
						{{--	<th>Họ và tên</th>--}}
							<th>Email</th>
							<th>Danh hiệu</th>
							<th >Đơn hàng</th>
							<th>Kiện hàng</th>
							<th>Xác nhận</th>
							@can('user_management')
								<th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
							@endcan
						</tr>
					</thead>
					<tbody>
						@foreach( $users as $key=>$user )
							<tr>
								<td> {{ $key+1 }}</td>
						{{--	@if($user->hasProfile()==true)
									<td><a href="{{url('admin/members/show/'.$user->username)}}">{{ $user->full_name }}</a></td>
								@else
									<td>{{ $user->full_name }}</td>
								@endif--}}

								<td><a href="{{url('admin/members/show/'.$user->email)}}">{{ $user->email }}</a></td>

								<td>{{ $user->levels->name }}
									<a data-code="{{$user->id}}" data-orderurl="{{url('admin/movelevel/customer/'.$user->id)}}" title="Thay đổi cấp độ thành viên" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#LevelUserDialog">
										<i class="fa fa-edit text-blue"></i>
									</a>
								</td>
								<td align="center"><a href="{{url('admin/members/order/'.$user->email)}}" style="text-decoration: none"> <b><font color="#ff0000">{{ $user->orders->count()}}</font> </b></a> </td>
								<td align="center"><a href="{{url('admin/members/package/'.$user->email)}}" style="text-decoration: none"><b><font color="#ff0000">{{ $user->packages->count()}}</font> </b></a></td>

								<td>
									{!! $user->isVerified() ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-close text-red"></i>' !!}
									@if(!$user->isVerified())
										{!! Form::open(['method' => 'PATCH', 'url' => url('admin/users/'.$user->email.'/verify'), 'style' => 'float:right;']) !!}
										<button type="submit" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.verifyuser') }}" style="align:right;" class="btn btn-xs btn-default btn-flat"><i class="fa fa-check text-green"></i></button>
										{!! Form::close() !!}
									@endif
								</td>
								@can('customer_management')
									<td>
										@can('user_management')
											@if($user->username != crminfo('admin_username'))
												<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.editroles') }}" class="btn btn-xs btn-default btn-flat" onclick="editUserRoles('{{ url('admin/roles/user/'.$user->username) }}')"><i class="fa fa-eye"></i> Phân quyền</button>
											@endif
										@endcan
										@can('customer_management')
											<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editUser('{{ url('admin/users/'.$user->username) }}')"><i class="fa fa-edit text-blue"></i></button>
										@endcan
										@can('customer_management')
											@if($user->username != crminfo('admin_username'))
												<button type="button" data-username="{{ $user->username }}" data-userdeleteurl="{{ url('admin/users/'.$user->username) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmUserDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
											@endif
										@endcan
										{!! $user->hasProfile() ? '' : '<a data-toggle="tooltip" title="Tạo Profile" class="btn btn-xs btn-default btn-flat" href="'.url("admin/profiles/".$user->username."/create").'"><i class="fa fa-plus text-green"></i></a>' !!}

									</td>
								@endcan
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pull-right">
					{{--<ul class="pagination">
						{!! $users->render() !!}
					</ul>--}}
				</div>
			@endcan
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	@can('user_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="addnewuser">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.createnewuser') }}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<form role="form" id="addNewUserForm" method="POST" action="{{ url('admin/users') }}">
								{!! csrf_field() !!}
								<div class="col-md-6">
										
									<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
										<label for="full_name">{{ trans('VNPCMS.forms.labels.fullname') }}*</label>
										<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.namesurname') }}" name="full_name" value="{{ old('full_name') ? old('full_name') : '' }}" required>
										@if ($errors->has('full_name'))
										<span class="help-block">
											<strong>{{ $errors->first('full_name') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
										<label for="username">{{ trans('VNPCMS.forms.labels.username') }}*</label>
										<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.username') }}" name="username" value="{{ old('username') ? old('username') : '' }}" required>
										@if ($errors->has('username'))
										<span class="help-block">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
										<label for="email">{{ trans('VNPCMS.forms.labels.email') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : '' }}" required>
										</div>
										@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
										@endif
									</div>
									
					              <div class="clearfix"></div><br />
									
								</div>
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
										<label for="password">{{ trans('VNPCMS.forms.labels.password') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control genpasswd" name="password" data-size="11" data-character-set="a-z,A-Z"  value="{{ old('password') }}" required>
										</div>
										@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
										<label for="password_confirmation">{{ trans('VNPCMS.forms.labels.confirmpassword') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control genpasswd" name="password_confirmation" data-size="11" data-character-set="a-z,A-Z"  value="{{ old('password_confirmation') }}" required>
										</div>
										@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-default btn-sm btn-genpasswd">{{ trans('VNPCMS.forms.buttons.generatepasswd') }}</button>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="minimal margin-r-5" name="notify" value="yes"/>&nbsp;{{ trans('VNPCMS.forms.checkboxes.notifyusernewacc') }}<br />
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.create') }}</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
		@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
			<script type="text/javascript">
				$('#addnewuser').modal('show');
			</script>
		@endif
	@endif
	@can('user_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="editUser">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.edituser') }}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<form role="form" id="editUserForm" method="POST" action="{{ url('admin/users/'.$user->username) }}">
									{!! method_field('PATCH') !!}
									{!! csrf_field() !!}
									<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
										<label for="full_name">{{ trans('VNPCMS.forms.labels.fullname') }}*</label>
										<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.namesurname') }}" name="full_name" value="{{ old('full_name') ? old('full_name') : '' }}" required>
										@if ($errors->has('full_name'))
										<span class="help-block">
											<strong>{{ $errors->first('full_name') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
										<label for="email">{{ trans('VNPCMS.forms.labels.email') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : '' }}" required>
										</div>
										@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
									</div>
								</form>
							</div>
							<div class="col-md-6">
								<!-- <h4>Change password</h4> -->
								<form role="form" id="editPasswordForm" method="POST" action="{{ url('admin/users/'.$user->username.'/password') }}">
									{!! method_field('PATCH') !!}
									{!! csrf_field() !!}
									<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
										<label for="password">{{ trans('VNPCMS.forms.labels.newpassword') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
										</div>
										@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
										<label for="password_confirmation">{{ trans('VNPCMS.forms.labels.confirmnewpassword') }}*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
										</div>
										@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.change') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
			@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
				<script type="text/javascript">
					$('#editUser').modal('show');
				</script>
			@endif
	@endif
	@can('user_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="confirmUserDelete">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmuserdeletion') }}</h4>
						</div>
						<div class="modal-body">
							<p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="username"></span></b>?</p>
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
	@can('user_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="editUserRoles">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.editroles') }}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<form role="form" id="updateUserRolesForm" method="POST" action="">
									{!! csrf_field() !!}
									<label for="roles">{{ trans('VNPCMS.forms.labels.roles_u') }}</label><br />
										@foreach(crmRoles() as $role)
											<div class="form-group">
												<input type="radio" class="minimal margin-r-5" name="roles" value="{{ $role->name }}" />&nbsp;&nbsp;{{ $role->label . ' (' . $role->name . ')' }}<br />
											</div>
										@endforeach
									<br style="clear:both;">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
	@endcan
</section><!-- /.content -->
@stop