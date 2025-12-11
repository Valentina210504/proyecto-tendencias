@extends('layouts.app')

@section('title','Crear Contrato')

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
                        <form method="POST" action="{{ route('contratos.store') }}">
                            @csrf
                            <div class="card-body">

                                {{-- MENSAJES DE ERROR --}}
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
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
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                @endif


                                {{-- FECHA INICIO --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha de Inicio <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="date" class="form-control" name="fecha_inicio"
                                                value="{{ old('fecha_inicio') }}" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- FECHA FINAL (OPCIONAL) --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha Final</label>
                                            <input type="date" class="form-control" name="fecha_final"
                                                value="{{ old('fecha_final') }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- SALARIO --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Salario <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="number" class="form-control" name="salario" min="0" step="0.01"
                                                placeholder="Ejemplo: 1500000" value="{{ old('salario') }}" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- CAMPOS OCULTOS --}}
                                <input type="hidden" name="estado" value="activo">
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                                            Registrar
                                        </button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('contratos.index') }}"
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