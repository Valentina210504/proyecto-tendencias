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
                        <form method="POST" action="{{ route('empresas.store') }}" enctype="multipart/form-data">
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
                                            <div class="d-flex align-items-center">
                                                <div id="empresaIconPreview" class="mr-3">
                                                    <div id="empresaIconBox"
                                                        style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #3b82f6 0%, #3b82f6dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                        <span id="empresaIniciales">--</span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="nombre" id="nombreEmpresa"
                                                    placeholder="Por ejemplo, Acme Corporation" autocomplete="off"
                                                    value="{{ old('nombre') }}" required>
                                            </div>
                                            <small class="form-text text-muted">Las iniciales se actualizarán
                                                automáticamente</small>
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

                                {{-- Imagen de la empresa --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><i class="fas fa-image text-info mr-1"></i>Logo
                                                de la Empresa</label>
                                            <div class="d-flex align-items-center">
                                                <div id="imagenPreview" class="mr-3" style="display: none;">
                                                    <img id="imagenPreviewImg" src="" alt="Vista previa"
                                                        style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                </div>
                                                <div id="imagenPlaceholder" class="mr-3">
                                                    <div
                                                        style="width: 80px; height: 80px; border-radius: 8px; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 24px;">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" name="imagen" id="imagenInput"
                                                        class="form-control-file" accept="image/*">
                                                    <small class="form-text text-muted">Formatos: JPG, PNG, GIF. Tamaño
                                                        máximo: 2MB</small>
                                                </div>
                                            </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    var colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4'];

    $('#nombreEmpresa').on('input', function() {
        var nombre = $(this).val().toUpperCase();
        var iniciales = nombre.length >= 2 ? nombre.substring(0, 2) : (nombre.length == 1 ? nombre +
            '-' : '--');
        var colorIndex = nombre.length > 0 ? nombre.charCodeAt(0) % colors.length : 0;
        var bgColor = colors[colorIndex];

        $('#empresaIniciales').text(iniciales);
        $('#empresaIconBox').css('background', 'linear-gradient(135deg, ' + bgColor + ' 0%, ' +
            bgColor + 'dd 100%)');
    });


    $('#imagenInput').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagenPreviewImg').attr('src', e.target.result);
                $('#imagenPreview').show();
                $('#imagenPlaceholder').hide();
            }
            reader.readAsDataURL(file);
        } else {
            $('#imagenPreview').hide();
            $('#imagenPlaceholder').show();
        }
    });
});
</script>
@endpush