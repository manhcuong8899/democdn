@can('config_management')
	<!-- Control Sidebar -->
	<aside class="sidebar control-sidebar control-sidebar-light">
		<ul class="sidebar-menu">
			<li class="header"><i class="fa fa-sliders" style="margin-right:5px;"></i>Cài đặt hệ thống</li>
			<li class="{{ setMenuActive('admin/users') }}">
				<a href="{{url('admin/users')}}">
					<i class="fa fa-user"></i>
					<span>Quản lý tài khoản</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
			</li>

			<li class="treeview {{ setMenuActive('admin/roles') }}">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Cấu hình phân quyền</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="{{ setMenuActive('admin/roles') }}"><a href="{{url('admin/roles')}}"><i class="fa fa-user"></i> Nhóm quyền hạn</a></li>
					<li class="{{ setMenuActive('admin/permissions') }}"><a href="{{url('admin/permissions')}}"><i class="fa fa-user"></i> Quyền hạn</a></li>

				</ul>
			</li>
		</ul>
	</aside><!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
@endcan