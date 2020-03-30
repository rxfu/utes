<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	@guest
		<div class="container">
			<a href="/" class="navbar-brand">
				<img src="{{ asset('admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">{{ config('setting.name') }}</span>
			</a>

			<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse order-1" id="navbarCollapse">
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="{{ route('login') }}" class="nav-link">登录</a>
					</li>
				</ul>
			</div>
		</div>
	@else
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="nav-link" data-widget="pushmenu">
					<i class="fa fa-bars"></i>
				</a>
			</li>
			@foreach ($menu_nav->menuitems as $item)
				<li class="nav-item d-done d-sm-inline-block">
					<a href="{{ empty($item->route) ? '#' : route($item->route) }}" class="nav-link" title="{{ $item->name }}">
						{{ $item->name }}
					</a>
				</li>
			@endforeach
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item d-done d-sm-inline-block">
				<a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
					<i class="nav-icon fas fa-sign-out-alt"></i>
					退出
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
					@csrf
				</form>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
					<i class="fa fa-th-large"></i>
				</a>
			</li>
		</ul>
	@endguest
</nav>