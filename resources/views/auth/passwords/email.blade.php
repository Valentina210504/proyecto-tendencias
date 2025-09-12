@extends('layouts.applogin')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ url('/') }}" class="h1"><b>¿Olvidaste tu contraseña?</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">
          ¿Olvidaste tu contraseña? Aquí puedes solicitar una nueva fácilmente.
        </p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="input-group mb-3">
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}"
               required autocomplete="email" autofocus
               placeholder="{{ __('Email Address') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>

        @error('email')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
                Solicitar nueva contraseña
            </button>
        </div>
    </div>
</form>



        <p class="mt-3 mb-1">
          <a href="{{ route('login') }}">{{ __('Log In') }}</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection