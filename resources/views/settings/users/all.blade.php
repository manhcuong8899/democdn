@extends('layouts.app')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('VNPCMS.pages.titles.settings') }}</h1>
</section>

<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.allusers') }}</h3>
		</div>
		<div class="box-body">
			@can('user_management')
				<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewuser">
					<i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
				</a>
			@endcan
			<br style="clear:both;">
			<br style="clear:both;">
			@can('user_management')
				<table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>
						{{--	<th>{{ trans('VNPCMS.forms.tables.columns.fullname') }}</th>--}}
							<th>{{ trans('VNPCMS.forms.tables.columns.username') }}</th>
							<th>Quyền hạn</th>
							<th>{{ trans('VNPCMS.forms.tables.columns.email') }}</th>
							<th>{{ trans('VNPCMS.forms.tables.columns.profile') }}</th>
							<th>{{ trans('VNPCMS.forms.tables.columns.lastlogin') }}</th>
							<th>{{ trans('VNPCMS.forms.tables.columns.verified') }}</th>
							@can('user_management')
								<th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
							@endcan
						</tr>
					</thead>
					<tbody>
						@foreach( $users as $user )
							<tr>
								<td {!! $user->username == crminfo('admin_username') ? 'style="background-color:#B5E4FF;"' : '' !!}>{{ $user->id }}</td>
							{{--	<td>{{ $user->full_name }}</td>--}}
								<td>{{ $user->username }}</td>
								<td> @foreach($user->roles as $role)
										{{$role->label}}
								@endforeach</td>
								<td>{{ $user->email }}</td>
								<td>
									@can('user_management')
										{!! $user->hasProfile() ? '<a href="'.url($user->profilePath()).'"><i class="fa fa-external-link text-blue"></i></a>' :  '' !!}
									@endcan
									@can('user_management')
										{!! $user->hasProfile() ? '' : '<a data-toggle="tooltip" title="'.trans("VNPCMS.forms.titles.createprofile").'" class="btn btn-xs btn-default btn-flat" href="'.url("admin/profiles/".$user->username."/create").'"><i class="fa fa-plus text-green"></i></a>' !!}
									@endcan
									@can('user_management')
										@if($user->hasProfile())
											{!! Form::open(['method' => 'DELETE', 'url' => url('admin/profiles/'.$user->username), 'style' => 'float:right;']) !!}
											<button type="submit" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.deleteprofile') }}" style="align:right;" class="btn btn-xs btn-default btn-flat"><i class="fa fa-trash text-red"></i></button>
											{!! Form::close() !!}
										@endif
									@endcan
								</td>
								<td>{{ $user->last_login }}</td>
								<td>
									{!! $user->isVerified() ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-close text-red"></i>' !!}
									@if(!$user->isVerified())
										{!! Form::open(['method' => 'PATCH', 'url' => url('users/'.$user->username.'/verify'), 'style' => 'float:right;']) !!}
										<button type="submit" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.verifyuser') }}" style="align:right;" class="btn btn-xs btn-default btn-flat"><i class="fa fa-check text-green"></i></button>
										{!! Form::close() !!}
									@endif
								</td>
								@can('user_management')
									<td>
										@can('user_management')
											@if($user->username != crminfo('admin_username'))
												<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.editroles') }}" class="btn btn-xs btn-default btn-flat" onclick="editUserRoles('{{ url('admin/roles/user/'.$user->username) }}')"><i class="fa fa-eye"></i> Phân quyền</button>
											@endif
										@endcan
										@can('user_management')
											<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editUser('{{ url('admin/users/'.$user->username) }}')"><i class="fa fa-edit text-blue"></i></button>
										@endcan
										@can('user_management')
											@if($user->username != crminfo('admin_username'))
												<button type="button" data-username="{{ $user->username }}" data-userdeleteurl="{{ url('admin/users/'.$user->username) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmUserDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
											@endif
										@endcan
									</td>
								@endcan
							</tr>
						@endforeach
					</tbody>
				</table>
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
						<h4 class="modal-title">Sửa phân quyền</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<form role="form" id="updateUserRolesForm" method="POST" action="">
									{!! csrf_field() !!}
									<label for="roles">Nhóm quyền</label><br />
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