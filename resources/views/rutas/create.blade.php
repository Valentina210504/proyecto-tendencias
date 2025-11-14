@extends('layouts.app')

@section('title','Crear Ruta')

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

                        <form method="POST" action="{{ route('rutas.store') }}">
                            @csrf
                            <div class="card-body">

                                {{-- Mensajes de error --}}
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

                                {{-- Nombre de la ruta --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Nombre de la Ruta <strong style="color:red;">(*)</strong>
                                            </label>
                                            <input type="text" class="form-control" name="nombre_ruta"
                                                placeholder="Ejemplo: Medellín - Bogotá" autocomplete="off"
                                                value="{{ old('nombre_ruta') }}" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Descripción --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripción <strong
                                                    style="color:red;">(*)</strong></label>
                                            <textarea name="descripcion" class="form-control" rows="3"
                                                placeholder="Descripción de la ruta"
                                                required>{{ old('descripcion') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Distancia en km --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Distancia (km) <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="distancia_en_km"
                                                placeholder="Ejemplo: 250.5" value="{{ old('distancia_en_km') }}"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Tiempo estimado --}}
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tiempo Estimado <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="time" class="form-control" name="tiempo_estimado" step="1"
                                                value="{{ old('tiempo_estimado') }}" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Costo del peaje --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Costo del Peaje (COP)</label>
                                            <input type="number" step="0.01" class="form-control" name="costo_peaje"
                                                placeholder="Ejemplo: 43500" value="{{ old('costo_peaje') }}">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="estado" value="1">
                                <input type="hidden" class="form-control" name="registrado_por"
                                    value="{{ Auth::user()->name }}">
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-6">
                                        <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-6">
                                        <a href="{{ route('rutas.index') }}"
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