@extends('layouts.app')

@section('title','Crear Tipo de Vehículo')

@section('content')
<div class="content-wrapper">

    <section class="content-header"></section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>

                        <form method="POST" action="{{ route('tipo_vehiculos.store') }}">
                            @csrf

                            <div class="card-body">

                                {{-- ERRORES --}}
                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close"
                                        data-dismiss="alert"><span>&times;</span></button>
                                </div>
                                @endif

                                {{-- NOMBRE --}}
                                <div class="form-group">
                                    <label>Nombre <strong style="color:red;">(*)</strong></label>
                                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                        placeholder="Ej: Bus, Camión, Moto" required>
                                </div>

                                {{-- DESCRIPCIÓN --}}
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="3"
                                        placeholder="Descripción del tipo de vehículo">{{ old('descripcion') }}</textarea>
                                </div>

                                {{-- CAPACIDAD PASAJEROS --}}
                                <div class="form-group">
                                    <label>Capacidad de Pasajeros <strong style="color:red;">(*)</strong></label>
                                    <input type="number" name="capacidad_pasajero" class="form-control"
                                        value="{{ old('capacidad_pasajero') }}" min="1" required>
                                </div>

                                {{-- CAPACIDAD CARGA --}}
                                <div class="form-group">
                                    <label>Capacidad de Carga (kg)</label>
                                    <input type="number" step="0.10" name="capacidad_carga" class="form-control"
                                        value="{{ old('capacidad_carga') }}">
                                </div>

                                {{-- CAPACIDAD GASOLINA --}}
                                <div class="form-group">
                                    <label>Capacidad de Gasolina (galones)</label>
                                    <input type="number" step="0.10" name="capacidad_gasolina" class="form-control"
                                        value="{{ old('capacidad_gasolina') }}">
                                </div>

                                {{-- HIDDEN: ESTADO SIEMPRE 1 --}}
                                <input type="hidden" name="estado" value="1">

                                {{-- HIDDEN: REGISTRADO POR --}}
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('tipo_vehiculos.index') }}"
                                            class="btn btn-danger btn-block">Atrás</a>
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