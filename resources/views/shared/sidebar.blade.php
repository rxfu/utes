<!-- Main sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  	<!-- Brand logo -->
  	<a href="{{ url('/') }}" class="brand-link">
		<img src="{{ asset('img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">{{ config('setting.slug') }}</span>
  	</a>

  	<!-- Sidebar -->
  	<div class="sidebar">
      	<!-- Sidebar user panel (optional) -->
      	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
          	<div class="image">
            	<img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
          	</div>
          	<div class="info">
            	<a href="#" class="d-block">{{ Auth::user()->name }}</a>
          	</div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                @foreach (config('menu.sidebar') as $items)
                    @if (is_array($items))
                        @foreach ($items as $item)
                            @isset($item['children'])
                                <li class="nav-item has-treeview">
                                    <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}" class="nav-link{{ isset($item['route']) && (request()->route()->getName() === $item['route']) ? ' active' : '' }}">
                                        @isset ($item['icon'])
                                            <i class="nav-icon fas fa-{{ $item['icon'] }}"></i>
                                        @endisset
                                        <p>
                                            {{ $item['title'] ?? '无标题' }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach ($item['children'] as $subitem)
                                            <li class="nav-item">
                                                <a href="{{ isset($subitem['route']) ? route($subitem['route']) : '#' }}" class="nav-link{{ isset($subitem['route']) && (request()->route()->getName() === $subitem['route']) ? ' active' : '' }}">
                                                    @isset ($subitem['icon'])               
                                                        <i class="nav-icon fas fa-{{ $subitem['icon'] }}"></i>
                                                    @else
                                                        <i class="nav-icon far fa-circle"></i>
                                                    @endisset
                                                    <p>{{ $subitem['title'] ?? '无标题' }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}" class="nav-link{{ isset($item['route']) && (request()->route()->getName() === $item['route']) ? ' active' : '' }}">
                                        @isset ($item['icon'])
                                            <i class="nav-icon fas fa-{{ $item['icon'] }}"></i>
                                        @endisset
                                        <p>{{ $item['title'] ?? '无标题' }}</p>
                                    </a>
                                </li>
                            @endisset
                        @endforeach
                    @else
                        <li class="nav-header">{{ $items }}</li>
                    @endif
                @endforeach
            </ul>
        </nav>
  	</div>
</aside>