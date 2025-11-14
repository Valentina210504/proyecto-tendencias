@extends('layouts.app')

@section('title','Crear Licencia')

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

                        <form method="POST" action="{{ route('licencias.store') }}">
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

                                {{-- Campos del formulario --}}
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="numero">Número de Licencia <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="numero" id="numero" class="form-control"
                                                placeholder="Ejemplo: ABC123456" value="{{ old('numero') }}" required
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="categoria">Categoría <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="categoria" id="categoria" class="form-control"
                                                placeholder="Ejemplo: B1, C2, A2" value="{{ old('categoria') }}"
                                                required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="fecha_expedicion">Fecha de Expedición <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="date" name="fecha_expedicion" id="fecha_expedicion"
                                                class="form-control" value="{{ old('fecha_expedicion') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="fecha_vencimiento">Fecha de Vencimiento <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                                                class="form-control" value="{{ old('fecha_vencimiento') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="conductor_id">Conductor Asociado <strong
                                                    style="color:red;">(*)</strong></label>
                                            <select name="conductor_id" id="conductor_id" class="form-control" required>
                                                <option value="">Seleccione un conductor</option>
                                                @foreach($conductores as $conductor)
                                                <option value="{{ $conductor->id }}"
                                                    {{ old('conductor_id') == $conductor->id ? 'selected' : '' }}>
                                                    {{ $conductor->nombre }} {{ $conductor->apellido }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Campos ocultos --}}
                                <input type="hidden" name="estado" value="activo">
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('licencias.index') }}"
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