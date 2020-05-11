<!-- Main sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  	<!-- Brand logo -->
  	<a href="{{ url('/') }}" class="brand-link">
		<img src="{{ asset('admin-lte/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">{{ config('setting.slug') }}</span>
  	</a>

  	<!-- Sidebar -->
  	<div class="sidebar">
      	<!-- Sidebar user panel (optional) -->
      	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
          	<div class="image">
            	<img src="{{ asset('admin-lte/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
          	</div>
          	<div class="info">
            	<a href="{{ route('users.show', Auth::user()) }}" class="d-block">{{ Auth::user()->name }}</a>
          	</div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  @foreach ($menuitems->getActiveByMenu('main') as $item)
                    @isset ($item['children'])
                        <li class="nav-item has-treeview">
                            <a href="{{ $item['url'] }}" class="nav-link">
                                {!! $item['icon'] !!}
                                <p>
                                    {{ $item['name'] }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($item['children'] as $child)
                                    <li class="nav-item">
                                        <a href="{{ $child['url'] }}" class="nav-link" title="{{ $child['name'] }}">
                                            {!! $child['icon'] !!}
                                            <p>{{ $child['name'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ $item['url'] }}" class="nav-link" title="{{ $item['name'] }}">
                                {!! $item['icon'] !!}
                                <p>{{ $item['name'] }}</p>
                            </a>
                        </li>
                    @endisset
                @endforeach
            </ul>
        </nav>
  	</div>
</aside>