<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('dashboard') }}">
                    <span class="brand-logo">
                        <img src="{{ asset('backend/images/assets/logo.png') }}" alt="">
                    </span>
                    <h2 class="brand-text">Menú</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ active('dashboard') }} nav-item">
                <a class="d-flex align-items-center" href="{{ url('dashboard') }}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate">Tablero</span>
                </a>
            </li>
            <li class="navigation-header">
                <span>Modulos</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="{{ active('customers*') }} nav-item">
                <a class="d-flex align-items-center" href="{{ url('customers') }}">
                    <i data-feather='users'></i>
                    <span class="menu-title text-truncate">Clientes</span>
                </a>
            </li>
            {{--<li class="nav-item has-sub {!! classActivePath('shipping') !!}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='map'></i>
                    <span class="menu-title text-truncate"">Envíos</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ active('shipping/percentage*') }}">
                        <a class="d-flex align-items-center" href="{{ url('shipping/percentage') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">Porcentage</span>
                        </a>
                    </li>
                </ul>
            </li>--}}
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Configuraciones</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
