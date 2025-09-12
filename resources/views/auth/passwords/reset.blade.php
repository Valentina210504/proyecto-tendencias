@extends('layouts.applogin')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ url('/') }}" class="h1"><b>Reset</b>Password</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Estás a un paso de tu nueva contraseña, recupérala ahora.</p>

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          {{-- Email --}}
          <div class="input-group mb-3">
            <input id="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ $email ?? old('email') }}" 
                   placeholder="Correo electrónico" required autocomplete="email" autofocus>
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

          {{-- Password --}}
          <div class="input-group mb-3">
            <input id="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   name="password" placeholder="Nueva contraseña" required autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
              <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          {{-- Confirm Password --}}
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" 
                   class="form-control" name="password_confirmation" 
                   placeholder="Confirmar contraseña" required autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Cambiar contraseña</button>
            </div>
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ route('login') }}">Iniciar sesión</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection