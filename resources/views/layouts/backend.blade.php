<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	@section('styles')
		<!-- stylesheets -->
		<link rel="stylesheet" href="{{ elixir('assets/backend/css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/animate.css') }}">

		<!-- Fonts Icon -->
		<link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/brankic.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/ionicons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/font-awesome.min.css') }}">
	@show

	@section('scripts')
		<!-- javascript -->
		<script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}"></script>
		<script src="{{ elixir('assets/backend/js/app.js') }}"></script>
	@show

	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body id="@yield('pageType')">
	<div id="wrapper">
		<div id="sidebar-default" class="main-sidebar">
			<div class="current-user">
				<a href="#" class="name">
					@if(Auth::user()->image)
						<img class="avatar" src="{{ asset('assets/backend/img/avatars/1.jpg') }}" />
					@else
						<img class="avatar" src="{{ asset('assets/backend/img/avatars/1.jpg') }}" />
					@endif
					<span>
						{{ Auth::user()->name }}
						<i class="fa fa-chevron-down"></i>
					</span>
				</a>
				<ul class="menu">
					<li>
						<a href="{{ url('/user/'.Auth::user()->email.'/edit') }}">Account settings</a>
					</li>
					<li>
						<a href="{{ url('/user/'.Auth::user()->email.'/billing')}}">Billing</a>
					</li>
					<li>
						<a href="{{ url('/backend/notifications') }}">Notifications</a>
					</li>
					<li>
						<a href="{{ url('/backend/support') }}">Support</a>
					</li>
					<li>
						<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
					</li>
				</ul>
			</div>
			<div class="menu-section">
				<h3>General</h3>
				<ul>
					<li>
						<a href="{{ url('/backend') }}" class="active">
							<i class="ion-android-earth"></i> 
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="{{ url('backend/customers') }}" data-toggle="sidebar">
							<i class="ion-person-stalker"></i> <span>Customers</span>
							<i class="fa fa-chevron-down"></i>
						</a>
						<ul class="submenu">
							<li><a href="{{ url('backend/customers') }}">Customers list</a></li>
							<li><a href="{{ url('backend/orders') }}">Orders</a></li>
						</ul>
					</li>
					<li>
						<a href="{{ url('backend/reports') }}" data-toggle="sidebar">
							<i class="ion-stats-bars"></i> <span>Reports</span>
							<i class="fa fa-chevron-down"></i>
						</a>
						<ul class="submenu">
							<li><a href="{{ url('backend/reports/orders') }}">Reports orders</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="menu-section">
				<h3>Application</h3>
				<ul>
					<li>
						<a href="{{ url('/backend/provider') }}">
							<i class="fa fa-building-o"></i> <span>Providers</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/backend/datacenter') }}">
							<i class="fa fa-database"></i> <span>Datacenters</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/backend/server') }}">
							<i class="fa fa-server"></i> <span>Servers</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/backend/pricing') }}">
							<i class="ion-card"></i> <span>Pricing</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="bottom-menu hidden-sm">
				<ul>
					<li><a href="{{ url('/backend/support') }}"><i class="ion-help"></i></a></li>
					<li>
						<a href="#">
							<i class="ion-archive"></i>
							<span class="flag"></span>
						</a>
						<ul class="menu">
							<li><a href="#">5 unread messages</a></li>
							<li><a href="#">12 tasks completed</a></li>
							<!-- <li><a href="#">3 features added</a></li> -->
						</ul>
					</li>

					<li>
						<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ion-log-out"></i></a>
						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
				</ul>
			</div>
		</div>

		<div id="content">
			<div class="menubar">
				<div class="sidebar-toggler visible-xs">
					<i class="ion-navicon"></i>
				</div>

				<div class="page-title">
					@yield('pageName')
				</div>
			</div>
			@if (session('status'))
            	<div class="alert alert-success">
                	{{ session('status') }}
            	</div>
        	@endif
			@yield('content')
			
		</div>
	</div>

</body>
</html>