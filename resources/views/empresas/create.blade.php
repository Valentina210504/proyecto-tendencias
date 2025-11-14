@extends('layouts.app')

@section('title','Crear Empresa')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        <form method="POST" action="{{ route('empresas.store') }}">
                            @csrf
                            <div class="card-body">
                                {{-- Agregado mensaje de error si existe --}}
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">NIT <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nit"
                                                placeholder="Por ejemplo, 900123456-7" autocomplete="off"
                                                value="{{ old('nit') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre"
                                                placeholder="Por ejemplo, Acme Corporation" autocomplete="off"
                                                value="{{ old('nombre') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Dirección <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="direccion" placeholder="Dirección"
                                                class="form-control" autocomplete="off" value="{{ old('direccion') }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Teléfono <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="telefono" placeholder="Teléfono"
                                                class="form-control" autocomplete="off" value="{{ old('telefono') }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="email" name="email" placeholder="correo@ejemplo.com"
                                                class="form-control" autocomplete="off" value="{{ old('email') }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="estado" value="1">
                                <input type="hidden" class="form-control" name="registrado_por"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('empresas.index') }}"
                                            class="btn btn-danger btn-block btn-flat">Atrás</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection