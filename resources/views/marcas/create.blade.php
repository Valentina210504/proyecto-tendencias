@extends('layouts.app')

@section('title','Crear Usuario')

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
                        <form method="POST" action="{{ route('marcas.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <!-- label nombre de la marca -->
                                            <label class="control-label">Nombre <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre"
                                                placeholder="Por ejemplo, Toyota" autocomplete="off"
                                                value="{{ old('nombre') }}"><br>
                                            <!-- label pais origen de marca  -->
                                            <label class="control-label">Pais de Origen <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="pais_origen" placeholder="País de Origen"
                                                class="form-control" autocomplete="off"
                                                value="{{ old('pais_origen') }}"><br>

                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="estado" value="1">
                                <input type="hidden" class="form-control" name="registradopor"
                                    value="{{ Auth::user()->id }}">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('marcas.index') }}"
                                            class="btn btn-danger btn-block btn-flat">Atras</a>
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