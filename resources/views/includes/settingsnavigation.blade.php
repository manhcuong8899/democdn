@can('config_management')
	<li class="header"><i class="fa fa-sliders" style="margin-right:5px;"></i> {{ trans('VNPCMS.menus.settings') }}</li>
					<li class="treeview {{ setMenuActive('') }}">
						<a href="#">
							<i class="fa fa-user"></i>
							<span>aaaaaaa</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">

									<li class="{{ setMenuActive('hjjj') }}"><a href="#"><i class="fa fa-user"></i> jhjhj</a></li>

						</ul>
					</li>
@endcan