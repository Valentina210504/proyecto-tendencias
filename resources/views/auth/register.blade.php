@extends('layouts.applogin')

@section('title', 'Registro')

@section('content')
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h1"><b>Agencia</b>Viajes</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Crea tu nueva cuenta</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="input-group mb-3">
          <input id="name" type="text" 
                 class="form-control @error('name') is-invalid @enderror" 
                 name="name" value="{{ old('name') }}" 
                 required autocomplete="name" autofocus 
                 placeholder="Nombre completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <!-- Email -->
        <div class="input-group mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 name="email" value="{{ old('email') }}" 
                 required autocomplete="email" 
                 placeholder="Correo electrónico">
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

        <!-- Password -->
        <div class="input-group mb-3">
          <input id="password" type="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 name="password" required 
                 autocomplete="new-password" 
                 placeholder="Contraseña">
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

        <!-- Confirmar Password -->
        <div class="input-group mb-3">
          <input id="password-confirm" type="password" 
                 class="form-control" 
                 name="password_confirmation" 
                 required autocomplete="new-password" 
                 placeholder="Repite la contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- Botón -->
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
                Acepto los <a href="#">términos</a>
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>

      <!-- Redes sociales -->
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Registrarse con Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Registrarse con Google+
        </a>
      </div>

      <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
    </div>
  </div>
</div>
@endsection
