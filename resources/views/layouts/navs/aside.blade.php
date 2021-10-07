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
            @role('executive_administrator')
                <li class="{{ active('users*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('users') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate">Usuarios</span>
                    </a>
                </li>
                <li class="{{ active('pending*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('pending') }}">
                        <i data-feather='upload'></i>
                        <span class="menu-title text-truncate">Cargar BD</span>
                    </a>
                </li>
            @endrole
            @hasanyrole('executive_administrator|legal_administrator|legal_executive')
                <li class="{{ active('pending*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('customers/create') }}">
                        <i data-feather='user'></i>
                        <span class="menu-title text-truncate">Crear Cliente</span>
                    </a>
                </li>
                <li class="{{ active('list-pending*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('list-preview') }}">
                        <i data-feather='alert-circle'></i>
                        <span class="menu-title text-truncate">Preview</span>
                    </a>
                </li>
                <li class="{{ active('list-pending*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('list-pending') }}">
                        <i data-feather='alert-circle'></i>
                        <span class="menu-title text-truncate">Pendientes</span>
                    </a>
                </li>
                <li class="{{ active('contract*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('contract/create/customer') }}">
                        <i data-feather='edit-3'></i>
                        <span class="menu-title text-truncate">Crear Contrato</span>
                    </a>
                </li>
                <li class="{{ active('list-contracts*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('list-contracts/list') }}">
                        <i data-feather='list'></i>
                        <span class="menu-title text-truncate">Listar Contratos</span>
                    </a>
                </li>
                <li class="{{ active('causes*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('causes/contracts') }}">
                        <i data-feather='file-text'></i>
                        <span class="menu-title text-truncate">Causas</span>
                    </a>
                </li>
            @endrole
            @hasanyrole('executive_administrator|legal_administrator|collection_executive')
                <li class="{{ active('collections*') }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('collections') }}">
                        <i data-feather='info'></i>
                        <span class="menu-title text-truncate">Cobranzas</span>
                    </a>
                </li>
            @endrole
        </ul>
    </div>
  </div>
