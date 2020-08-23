@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('VNPCMS.pages.titles.settings') }}</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.userroles') }}</h3>
				</div>
				<div class="box-body">
					@can('role_management')
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Chúng tôi không khuyên bạn nên xóa các vai trò CMS mặc định, làm như vậy có thể ảnh hưởng đến hành vi của Quản trị viên. Hãy cân nhắc thêm những cái mới để thay thế.
					</div>
					@endcan
					
					@can('role_management')
						<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewrole" style="clear:both;margin-bottom:10px;">
							<i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
						</a>
					@endcan
					
					<table class="table table-responsive no-padding table-hover">
						<tbody>
							<tr>
								<th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>
								<th>Nhóm quyền</th>
								<th>Tên nhóm quyền</th>
								<th>Thao tác</th>
							</tr>
							@foreach($roles as $role)
								<tr>
									<td>{{ $role->id }}</td>
									<td><a href="{{url('admin/permissions')}}">{{ $role->name }}</a> </td>
									<td>{{ $role->label }}</td>
									<td>
										@if($role->name != 'administrator')
											@can('role_management')
												<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editRole('{{ url('admin/roles/'.$role->id) }}', '{{ getCurrentSessionAppLocale() }}')"><i class="fa fa-edit text-blue"></i></button>
											@endcan
											@can('role_management')
												<button type="button" data-rolename="{{ $role->name }}" data-roleid="{{ $role->id }}" data-roleurl="{{ url('admin/roles/'.$role->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmRoleDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
											@endcan
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	@can('role_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="confirmRoleDelete">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmroledeletion') }}</h4>
						</div>
						<div class="modal-body">
							<p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="rolename"></span></b>?</p>
							<p><b> Xóa một nhóm quyền sẽ loại bỏ tất cả các mối quan hệ của nó với quyền hạn và Quyền của Quản trị viên</b></p>
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
	@can('role_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="addnewrole">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.createnewrole') }}</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="{{ url('admin/roles') }}" METHOD='POST'>
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
									<label for="name">Nhóm quyền*</label>
									<input class="form-control" type="text" name="name" placeholder="Nhập ký tự thường, không chứa khoảng trắng và ký tự đặc biệt."  value="{{ old('name') }}" required>

									@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('label') ? ' has-error' : ' has-feedback' }}">
									<label for="label">Tên nhóm quyền*</label>
									<input class="form-control" type="text" name="label" placeholder="Nhập tên nhóm quyền" value="{{ old('label') }}" required>
									
									@if ($errors->has('label'))
									<span class="help-block">
										<strong>{{ $errors->first('label') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.create') }}</button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
		</div>
		<!-- If role create request has error, open aaddnewrole modal -->
		@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
		<script type="text/javascript">
			$('#addnewrole').modal('show');
		</script>
		@endif
	@endcan
	@can('role_management')
		<div class="modal fade" tabindex="-1" role="dialog" id="editRole">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Sửa nhóm quyền</h4>
						</div>
						<div class="modal-body">
							<form id="editRoleForm" role="form" action="" METHOD='POST'>
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('label') ? ' has-error' : ' has-feedback' }}">
									<label for="label">Tên nhóm quyền*</label>
									<input class="form-control" type="text" name="label" placeholder="Tên nhóm quyền" value="{{ old('label') }}" required>
									
									@if ($errors->has('label'))
									<span class="help-block">
										<strong>{{ $errors->first('label') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
		</div>
		<!-- If role create request has error, open aaddnewrole modal -->
		@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
		<script type="text/javascript">
			$('#editRole').modal('show');
		</script>
		@endif
	@endcan
</section><!-- /.content -->

@stop