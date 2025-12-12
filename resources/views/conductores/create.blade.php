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

                        <form method="POST" action="{{ route('conductores.store') }}" enctype="multipart/form-data">
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
                                    <div class="col-12 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div id="conductorAvatarPreview" class="mr-3">
                                                <div id="conductorAvatarBox"
                                                    style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #10b981 0%, #10b981dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <span id="conductorIniciales">--</span>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-0">Datos del Conductor</h5>
                                                <small class="text-muted">Las iniciales se actualizarán
                                                    automáticamente</small>
                                            </div>
                                        </div>
                                    </div>
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

                                {{-- Foto del conductor --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><i
                                                    class="fas fa-camera text-info mr-1"></i>Foto del Conductor</label>
                                            <div class="d-flex align-items-center">
                                                <div id="imagenPreview" class="mr-3" style="display: none;">
                                                    <img id="imagenPreviewImg" src="" alt="Vista previa"
                                                        style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                </div>
                                                <div id="imagenPlaceholder" class="mr-3">
                                                    <div
                                                        style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 28px;">
                                                        <i class="fas fa-user"></i>
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

@push('scripts')
<script>
$(document).ready(function() {
    var colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'];

    function updateAvatar() {
        var nombre = $('#nombre').val().toUpperCase();
        var apellido = $('#apellido').val().toUpperCase();
        var iniciales = (nombre.charAt(0) || '-') + (apellido.charAt(0) || '-');
        var colorIndex = nombre.length > 0 ? nombre.charCodeAt(0) % colors.length : 0;
        var bgColor = colors[colorIndex];

        $('#conductorIniciales').text(iniciales);
        $('#conductorAvatarBox').css('background', 'linear-gradient(135deg, ' + bgColor + ' 0%, ' + bgColor +
            'dd 100%)');
    }

    $('#nombre, #apellido').on('input', updateAvatar);


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