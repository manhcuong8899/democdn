	<header class="main-header">
		<!-- Logo -->
		<a href="/" class="logo" target="bank">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">CMS</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">HỆ QUẢN TRỊ</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- Application locale switcher -->

						{{--<li class="dropdown messages-menu locale-dropdown pull-left">
							<a href="#" class="dropdown-toggle pull-left" data-toggle="dropdown">
                                <i class="fa fa-flag"></i>&nbsp;{{ config('app.locale') }}&nbsp;<i class="caret"></i>
							</a>
							<ul class="dropdown-menu">
								@foreach (config('app.supported_locales') as $lang => $language)
									@if ($lang != getCurrentSessionAppLocale())
									<li>
										<a href="{{ route('locale.switch', $lang) }}">{{$language}}</a>
									</li>
									@endif
								@endforeach
							</ul>
						</li>--}}


					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">

						<!-- Authentication Links -->
						@if (Auth::guest())
						<li><a href="{{ url('/login') }}">{{ trans('VNPCMS.forms.labels.login') }}</a></li>
						@if(crminfo('enable_registration') == 1)
						<li><a href="{{ url('/register') }}">{{ trans('VNPCMS.forms.labels.register') }}</a></li>
						@endif
						@else
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							{{--<img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="user-image">--}}
							<span class="hidden-xs">{{ Auth::user()->full_name }}</span> <i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								{{--<img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="" alt="User Image">
								<p>--}}
									{{ Auth::user()->full_name }}
									<small>Member since Nov. 2017</small>
								</p>
							</li>

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									@if (!Auth::user()->hasProfile() AND Auth::user()->hasRole(['member', 'administrator']))
										<a href="{{ url('admin/users/'.Auth::user()->username.'/edit') }}" class="btn btn-default btn-flat">{{ trans('VNPCMS.forms.labels.editaccount') }}</a><br /><br />
										<a href="{{ url('admin/profiles/'. Auth::user()->username .'/create') }}" class="btn btn-success btn-flat">{{ trans('VNPCMS.forms.labels.createprofile') }}</a>
									@elseif (Auth::user()->hasProfile())
										<a href="{{ url(Auth::user()->profilePath()) }}" class="btn btn-default btn-flat">{{ trans('VNPCMS.forms.labels.profile') }}</a>
									@else
										<a href="{{ url('admin/users/'.Auth::user()->username.'/edit') }}" class="btn btn-default btn-flat">Edit Account</a>
									@endif
								</div>
								<div class="pull-right">
									<a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat"><i class="fa fa-power-off text-red"></i> {{ trans('VNPCMS.forms.labels.logout') }}</a>
								</div>
							</li>
						</ul>
					</li>
					@endif
					@can('config_management')
						<!-- Control Sidebar Toggle Button -->
						<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
					@endcan
				</ul>
			</div>
		</nav>
	</header>