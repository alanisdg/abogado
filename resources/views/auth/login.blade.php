@extends('auth.main')

@section('title', 'Inicio de Sesión')

@section('content')
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <img src="{{ asset('backend/images/assets/logo.png') }}" style="width: 50%;" alt="">
                    </a>

                    <h4 class="card-title mb-1">Inicio de Sesión!. 👋</h4>

                    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="login-email" class="form-label">Correo Electrónico</label>
                            <input
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                id="login-email"
                                name="email"
                                placeholder="john@example.com"
                                aria-describedby="login-email"
                                tabindex="1"
                                autofocus
                            />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="login-email" class="form-label">Contraseña</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                type="password"
                                class="form-control form-control-merge"
                                id="login-password"
                                name="password"
                                tabindex="2"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="login-password"
                                />
                                <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" tabindex="4">Acceder <i data-feather='log-in'></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
