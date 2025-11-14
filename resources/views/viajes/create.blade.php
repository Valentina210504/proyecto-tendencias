@extends('layouts.app')

@section('title','Crear Viaje')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>

                        <form method="POST" action="{{ route('viajes.store') }}">
                            @csrf

                            <div class="card-body">

                                {{-- Mensaje de error si existe --}}
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                @endif

                                {{-- Validaciones --}}
                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                @endif


                                {{-- VEHÍCULO --}}
                                <div class="form-group">
                                    <label>Vehículo <strong style="color:red;">(*)</strong></label>
                                    <select name="vehiculo_id" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- CONDUCTOR --}}
                                <div class="form-group">
                                    <label>Conductor <strong style="color:red;">(*)</strong></label>
                                    <select name="conductor_id" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($conductores as $conductor)
                                        <option value="{{ $conductor->id }}">{{ $conductor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- RUTA --}}
                                <div class="form-group">
                                    <label>Ruta <strong style="color:red;">(*)</strong></label>
                                    <select name="ruta_id" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($rutas as $ruta)
                                        <option value="{{ $ruta->id }}">{{ $ruta->nombre_ruta }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- DESCRIPCIÓN --}}
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="2"
                                        placeholder="Descripción del viaje">{{ old('descripcion') }}</textarea>
                                </div>

                                {{-- RECORRIDO --}}
                                <div class="form-group">
                                    <label>Recorrido (Km) <strong style="color:red;">(*)</strong></label>
                                    <input type="number" name="recorrido" class="form-control"
                                        placeholder="Ejemplo: 120" value="{{ old('recorrido') }}" required>
                                </div>

                                {{-- TIEMPO ESTIMADO --}}
                                <div class="form-group">
                                    <label>Tiempo Estimado (HH:MM:SS) <strong style="color:red;">(*)</strong></label>
                                    <input type="time" step="1" name="tiempo_estimado" class="form-control"
                                        value="{{ old('tiempo_estimado') }}" required>
                                </div>

                                {{-- COSTO TOTAL --}}
                                <div class="form-group">
                                    <label>Costo Total ($) <strong style="color:red;">(*)</strong></label>
                                    <input type="number" step="0.01" name="costo_total" class="form-control"
                                        placeholder="Ej: 45000" value="{{ old('costo_total') }}" required>
                                </div>

                                {{-- Estado y registrado_por --}}
                                <input type="hidden" name="estado" value="1">
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                                    </div>

                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('viajes.index') }}" class="btn btn-danger btn-block">Atrás</a>
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