@extends('layouts.app')

@section('title', 'Registrar Conductor')

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
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-secondary">
                            <h3 class="mb-0 text-white">@yield('title')</h3>
                        </div>

                        <form method="POST" action="{{ route('conductores.store') }}">
                            @csrf
                            <div class="card-body">

                                {{-- Mensaje de error general --}}
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                {{-- Errores de validación --}}
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

                                {{-- Campos del formulario --}}
                                <div class="row">
                                    <!-- Nombre -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre <strong class="text-danger">*</strong></label>
                                            <input type="text" id="nombre" name="nombre" class="form-control"
                                                placeholder="Ejemplo: Juan" value="{{ old('nombre') }}" required>
                                        </div>
                                    </div>

                                    <!-- Apellido -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido">Apellido <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" id="apellido" name="apellido" class="form-control"
                                                placeholder="Ejemplo: Pérez" value="{{ old('apellido') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="documento">Documento <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" id="documento" name="documento" class="form-control"
                                                placeholder="Número de documento" value="{{ old('documento') }}"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Fecha de contrato -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_contrato">Fecha de Contrato</label>
                                            <input type="date" id="fecha_contrato" name="fecha_contrato"
                                                class="form-control" value="{{ old('fecha_contrato') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado -->
                                <input type="hidden" name="estado" value="activo">

                                <!-- Registrado por -->
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4 mb-2 mb-lg-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Registrar
                                        </button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('conductores.index') }}" class="btn btn-danger btn-block">
                                            Atrás
                                        </a>
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