@extends('layouts.applogin')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <!-- Logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h1"><b>Agencia</b>Viajes</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicia sesión para continuar</p>

      <!-- Formulario de login -->
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 name="email" value="{{ old('email') }}" 
                 required autocomplete="email" autofocus placeholder="Email">
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

        <div class="input-group mb-3">
          <input id="password" type="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 name="password" required 
                 autocomplete="current-password" placeholder="Password">
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

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Recuérdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Ingresar con Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Ingresar con Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      @if (Route::has('password.request'))
        <p class="mb-1">
          <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
        </p>
      @endif

      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Registrar nueva cuenta</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection
