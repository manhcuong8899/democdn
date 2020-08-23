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
			<h3 class="box-title">{{ trans('VNPCMS.pages.subtitles.menus') }}</h3>
		</div>
		<div class="box-body">
			@can('config_management')
				<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewmenu">
					<i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
				</a>
			@endcan
			@can('config_management')
				<!-- Supporting only 2 dimensions -->
				<div class="box-body">
					@foreach ($menus as $menugroup => $submenus)
						<br style="clear:both;">
						<h3>
							@if($menugroup == 'public')
								{{ trans('VNPCMS.pages.subtitles.publicmenus') }}
							@elseif($menugroup == 'cms')
								{{ trans('VNPCMS.pages.subtitles.mainmenus') }}
							@elseif($menugroup == 'settings')
								{{ trans('VNPCMS.pages.subtitles.settingsmenus') }}
							@elseif($menugroup == 'top')
								{{ trans('VNPCMS.pages.subtitles.topmenus') }}
							@elseif($menugroup == 'left')
								{{ trans('VNPCMS.pages.subtitles.leftmenus') }}
							@elseif($menugroup == 'right')
								{{ trans('VNPCMS.pages.subtitles.right') }}
							@elseif($menugroup == 'botom')
								{{ trans('VNPCMS.pages.subtitles.botommenus') }}
							@endif
						</h3>
						<table class="table table-responsive no-padding table-hover">
							<tbody>
								<tr>
									<th>{{ trans('VNPCMS.forms.tables.columns.icon') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.slug') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.title') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.location') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.parent') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.permission') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.group') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.order') }}</th>
									<th>{{ trans('VNPCMS.forms.tables.columns.description') }}</th>
									@can('config_management')
										<th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
									@endcan
								</tr>
								@foreach( $submenus as $menu )
									@if($menu->children->count())
										@if(empty($menu->parent_slug))
											<tr style="background-color:#ebebeb;">
												<td><i class="fa {{ $menu->icon }}"></i></td>
												<td>{{ $menu->slug }}</td>
												<td>{{ $menu->title }}</td>
												<td>{{ $menu->url }}</td>
												<td>{{ empty($menu->parent_slug) ? '' : $menu->parent_slug }}</td>
												<td>{{ $menu->permission->label }}</td>
												<td>{{ $menu->menu_group }}</td>
												<td>{{ $menu->menu_order }}</td>
												<td>{{ $menu->description }}</td>
												@can('config_management')
													<td>
														@if(isCRMMultilingual())
															<button type="button" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('admin/settings/menus/'.$menu->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.translate') }}" ></i></button>
														@endif

														<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('admin/settings/menus/'.$menu->id) }}')"><i class="fa fa-edit text-blue"></i></button>

														@can('config_management')
															<button type="button" data-menuname="{{ $menu->title }}" data-deletemenuurl="{{ url('admin/settings/menus/'.$menu->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
														@endcan
													</td>
												@endcan
											</tr>
											@foreach($menu->children as $child)
											@if($child->locale == getCurrentSessionAppLocale())
                                                <tr>
                                                    <td><i class="fa {{ $child->icon }}"></i></td>
                                                    <td>{{ $child->slug }}</td>
                                                    <td>{{ $child->title }}</td>
                                                    <td>{{ $child->url }}</td>
                                                    <td>{{ empty($child->parent_slug) ? '' : $child->parent_slug }}</td>
                                                    <td>{{ $child->permission->label }}</td>
                                                    <td>{{ $child->menu_group }}</td>
                                                    <td>{{ $child->menu_order }}</td>
                                                    <td>{{ $child->description }}</td>
                                                    @can('config_management')
                                                        <td>
                                                            @if(isCRMMultilingual())
                                                                <button type="button" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('admin/settings/menus/'.$child->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.translate') }}"></i></button>
                                                            @endif

                                                            <button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}"  class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('admin/settings/menus/'.$child->id) }}')"><i class="fa fa-edit text-blue"></i></button>

                                                            @can('config_management')
                                                                <button type="button"data-menuname="{{ $child->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-deletemenuurl="{{ url('admin/settings/menus/'.$child->id) }}" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}" ></i></button>
                                                            @endcan
                                                        </td>
                                                    @endcan
                                                </tr>
                                            @endif
											@endforeach
										@endif
									@else
										@if(empty($menu->parent_slug))
											<tr style="background-color:#ebebeb;">
												<td><i class="fa {{ $menu->icon }}"></i></td>
												<td>{{ $menu->slug }}</td>
												<td>{{ $menu->title }}</td>
												<td>{{ $menu->url }}</td>
												<td>{{ empty($menu->parent_slug) ? '' : $menu->parent_slug }}</td>
												<td>{{ $menu->permission->label }}</td>
												<td>{{ $menu->menu_group }}</td>
												<td>{{ $menu->menu_order }}</td>
												<td>{{ $menu->description }}</td>
												@can('config_management')
													<td>
														@if(isCRMMultilingual())
															<button type="button" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('admin/settings/menus/'.$menu->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.translate') }}"></i></button>
														@endif

														<button type="button" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('admin/settings/menus/'.$menu->id) }}')"><i class="fa fa-edit text-blue"></i></button>
														@can('config_management')
															<button type="button" data-menuname="{{ $menu->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-deletemenuurl="{{ url('admin/settings/menus/'.$menu->id) }}" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
														@endcan
													</td>
												@endcan
											</tr>
										@endif
									@endif
								@endforeach
							</tbody>
						</table>
					@endforeach
				</div>
			@endcan
		</div><!-- /.box-body -->
	</div><!-- /.box -->

	<div class="row">
		@can('config_management')
			<div class="modal fade" tabindex="-1" role="dialog" id="addnewmenu">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.createnewmenu') }}</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="{{ url('admin/settings/menus') }}" METHOD="POST">
								{!! csrf_field() !!}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group{{ $errors->has('icon') ? ' has-error' : ' has-feedback' }}">
											<label for="icon">{{ trans('VNPCMS.forms.labels.fontawesomeicon') }}*</label>
											<div class="input-group">
												<input name="icon" class="form-control icp icp-auto iconpicker-input iconpicker-element" value="fa-circle-o" type="text" required>
												<span class="input-group-addon"></span>
											</div>
											@if ($errors->has('icon'))
											<span class="help-block">
												<strong>{{ $errors->first('icon') }}</strong>
											</span>
											@endif
										</div>
										<br>
										<input type="hidden" class="form-control" name="locale" value="{{ getCurrentSessionAppLocale() }}" required/>
										<div class="form-group{{ $errors->has('slug') ? ' has-error' : ' has-feedback' }}">
											<label for="slug">{{ trans('VNPCMS.forms.labels.slug') }}*</label>
											<input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required/>
											<p>Exc: users, reports, expenses (all lowercase)</p>
											@if ($errors->has('slug'))
											<span class="help-block">
												<strong>{{ $errors->first('slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('parent_slug') ? ' has-error' : ' has-feedback' }}">
											<label for="parent_slug">{{ trans('VNPCMS.forms.labels.parentmenu') }}</label>
											<select class="form-control" name="parent_slug">
												<option value="" selected>{{ trans('VNPCMS.forms.dropdowns.none') }}</option>
												@foreach (getParentMenus() as $parent)
													<option value="{{ $parent->slug }}" {{ old('parent_slug') == $parent->slug ? "selected" : "" }}>{{ $parent->title . ' ('.$parent->slug.')' }}</option>
												@endforeach
											</select>
											<p>{{ trans('VNPCMS.forms.help.selectnonemenu') }}</p>
											@if ($errors->has('parent_slug'))
											<span class="help-block">
												<strong>{{ $errors->first('parent_slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
											<label for="menu_order">{{ trans('VNPCMS.forms.labels.order') }}*</label>
											<input type="number" class="form-control" placeholder="0" min="0" name="menu_order" value="{{ old('menu_order') ? old('menu_order') : 0 }}" required>
											<p>{{ trans('VNPCMS.forms.help.highestordermenu') }}</p>
											@if ($errors->has('menu_order'))
											<span class="help-block">
												<strong>{{ $errors->first('menu_order') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
													<label for="title">{{ trans('VNPCMS.forms.labels.name') }}*</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.example_u') }}" name="title" value="{{ old('title') }}" required>
													@if ($errors->has('title'))
													<span class="help-block">
														<strong>{{ $errors->first('title') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('url') ? ' has-error' : ' has-feedback' }}">
													<label for="url">{{ trans('VNPCMS.forms.labels.location') }}</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.example_location') }}" name="url" value="{{ old('url') }}">
													@if ($errors->has('url'))
													<span class="help-block">
														<strong>{{ $errors->first('url') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
													<label for="description">{{ trans('VNPCMS.forms.labels.description') }}</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.description') }}" name="description" value="{{ old('description') }}">

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group{{ $errors->has('permission_id') ? ' has-error' : ' has-feedback' }}">
													<label for="permission_id">{{ trans('VNPCMS.forms.labels.permission') }}*</label>
													<select class="form-control" name="permission_id" required>
														<option disabled selected>{{ trans('VNPCMS.forms.dropdowns.selectpermission') }}</option>
														@foreach (crmPermissions() as $permission)
															<option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? "selected" : "" }}>{{ $permission->name . ' - ' .$permission->label }}</option>
														@endforeach
													</select>
													<p>{{ trans('VNPCMS.forms.help.selectpermissionmenu') }}</p>
													@if ($errors->has('permission_id'))
													<span class="help-block">
														<strong>{{ $errors->first('permission_id') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
													<label for="menu_group">{{ trans('VNPCMS.forms.labels.menugroup') }}*</label>
													<select class="form-control" name="menu_group" required>
														<option disabled selected>{{ trans('VNPCMS.forms.dropdowns.selectgroup') }}</option>
														@foreach (Config('VNPCMS.menu_groups') as $menugroup)
															<option value="{{ $menugroup }}" {{ old('menu_group') == $menugroup ? "selected" : "" }}>{{ ucfirst($menugroup) }}</option>
														@endforeach
													</select>
													@if ($errors->has('menu_group'))
													<span class="help-block">
														<strong>{{ $errors->first('menu_group') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.create') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</div>
			<!-- If edit menu request has error, open editmenu modal -->
			@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
			<script type="text/javascript">
				$('#addnewmenu').modal('show');
			</script>
			@endif
		@endcan
		@can('config_management')
			<div class="modal fade" tabindex="-1" role="dialog" id="editmenu">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.editmenu') }}</h4>
						</div>
						<div class="modal-body">
							<form role="form" id="editMenuForm" method="POST" action="">
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group{{ $errors->has('icon') ? ' has-error' : ' has-feedback' }}">
											<label for="icon">{{ trans('VNPCMS.forms.labels.fontawesomeicon') }}*</label>
											<div class="input-group">
												<input name="icon" class="form-control icp icp-auto iconpicker-input iconpicker-element" value="fa-circle-o" type="text" required>
												<span class="input-group-addon"></span>
											</div>
											@if ($errors->has('icon'))
											<span class="help-block">
												<strong>{{ $errors->first('icon') }}</strong>
											</span>
											@endif
										</div>
										<br>
										<div class="form-group{{ $errors->has('parent_slug') ? ' has-error' : ' has-feedback' }}">
											<label for="parent_slug">{{ trans('VNPCMS.forms.labels.parentmenu') }}</label>
											<select class="form-control" name="parent_slug">
												<option value="" selected>{{ trans('VNPCMS.forms.dropdowns.none') }}</option>
												@foreach (getParentMenus() as $parent)
													<option value="{{ $parent->slug }}" {{ old('parent_slug') == $parent->slug ? "selected" : "" }}>{{ $parent->title . ' ('.$parent->slug.')' }}</option>
												@endforeach
											</select>
											<p>{{ trans('VNPCMS.forms.help.selectnonemenu') }}</p>
											@if ($errors->has('parent_slug'))
											<span class="help-block">
												<strong>{{ $errors->first('parent_slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
											<label for="menu_order">{{ trans('VNPCMS.forms.labels.order') }}*</label>
											<input type="number" class="form-control" placeholder="0" min="0" name="menu_order" value="{{ old('menu_order') }}" required>
											<p>{{ trans('VNPCMS.forms.help.highestordermenu') }}</p>
											@if ($errors->has('menu_order'))
											<span class="help-block">
												<strong>{{ $errors->first('menu_order') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
													<label for="title">{{ trans('VNPCMS.forms.labels.name') }}*</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.example_u') }}" name="title" value="{{ old('title') }}" required>
													@if ($errors->has('title'))
													<span class="help-block">
														<strong>{{ $errors->first('title') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('url') ? ' has-error' : ' has-feedback' }}">
													<label for="url">{{ trans('VNPCMS.forms.labels.location') }}</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.example_location') }}" name="url" value="{{ old('url') }}">
													@if ($errors->has('url'))
													<span class="help-block">
														<strong>{{ $errors->first('url') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
													<label for="description">{{ trans('VNPCMS.forms.labels.description') }}</label>
													<input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.description') }}" name="description" value="{{ old('description') }}">

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group{{ $errors->has('permission_id') ? ' has-error' : ' has-feedback' }}">
													<label for="permission_id">{{ trans('VNPCMS.forms.labels.permission') }}*</label>
													<select class="form-control" name="permission_id" required>
														<option disabled selected>{{ trans('VNPCMS.forms.dropdowns.selectpermission') }}</option>
														@foreach (crmPermissions() as $permission)
															<option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? "selected" : "" }}>{{ $permission->name . ' - ' .$permission->label }}</option>
														@endforeach
													</select>
													<p>{{ trans('VNPCMS.forms.help.selectpermissionmenu') }}</p>
													@if ($errors->has('permission_id'))
													<span class="help-block">
														<strong>{{ $errors->first('permission_id') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
													<label for="menu_group">{{ trans('VNPCMS.forms.labels.menugroup') }}*</label>
													<select class="form-control" name="menu_group" required>
														<!-- <option disabled selected>Select group</option> -->
														@foreach (Config('VNPCMS.menu_groups') as $menugroup)
															<option value="{{ $menugroup }}" {{ Request::old('menu_group') == $menugroup ? "selected" : "" }}>{{ ucfirst($menugroup) }}</option>
														@endforeach
													</select>

													@if ($errors->has('menu_group'))
													<span class="help-block">
														<strong>{{ $errors->first('menu_group') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</div>
			<!-- If edit menu request has error, open editmenu modal -->
			@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
			<script type="text/javascript">
				$('#editmenu').modal('show');
			</script>
			@endif
		@endcan
		@can('config_management')
			@if(isCRMMultilingual())
				<div class="modal fade" tabindex="-1" role="dialog" id="translatemenu">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.createtranslation') }}</h4>
							</div>
							<div class="modal-body">
								<div class="alert alert-help">
								    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								    {{ trans('VNPCMS.help.translation', ['object'=>trans('VNPCMS.models.menu')]) }}
								</div>
								<form role="form" id="translateMenuForm" method="POST" action="">
									{!! csrf_field() !!}
									<div class="row">
										<div class="col-md-12">
											<div class="form-group {{ $errors->has('locale') ? ' has-error' : ' has-feedback' }}">
											    <label for="locale">{{ trans('VNPCMS.forms.labels.selectlocale') }}</label>
											    <select class="form-control" name="locale" required>
											        <option disabled selected>{{ trans('VNPCMS.forms.dropdowns.selectlocale') }}</option>
											        @foreach (getAvailableAppLocaleArray() as $localekey => $localevalue)
											            @if($localekey != getCurrentSessionAppLocale())
											                <option value="{{ $localekey }}" {{ old('locale') == $localekey ? "selected" : "" }}>{{ $localekey . ' - ' .$localevalue }}</option>
											            @endif
											        @endforeach
											    </select>

											    @if ($errors->has('locale'))
											    <span class="help-block">
											        <strong>{{ $errors->first('locale') }}</strong>
											    </span>
											    @endif
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.create') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
				</div>
				<!-- If edit menu request has error, open editmenu modal -->
				@if ($errors->has('error_code') AND $errors->first('error_code') == 7)
				<script type="text/javascript">
					$('#translatemenu').modal('show');
				</script>
				@endif
			@endif
		@endcan	
		@can('config_management')
			<div class="modal fade" tabindex="-1" role="dialog" id="confirmMenuDelete">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmmenudeletion') }}</h4>
							</div>
							<div class="modal-body">
								<p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="menuname"></span></b>?</p>
								<p><b>{{ trans('VNPCMS.forms.labels.note') }}: </b>{{ trans('VNPCMS.forms.help.notemenudeletion') }}</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
								{!! Form::open(['method' => 'DELETE', 'id'=>'deleteMenuForm']) !!}
								<button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('VNPCMS.forms.buttons.delete') }}</button>
								{!! Form::close() !!}
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
			</div>
		@endcan
	</div>
</section><!-- /.content -->

@stop
