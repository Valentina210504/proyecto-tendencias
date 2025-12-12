@extends('layouts.app')

@section('title','Crear Marca')

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
                        <form method="POST" action="{{ route('marcas.store') }}" enctype="multipart/form-data">
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
                                            <label class="control-label">Nombre <strong
                                                    style="color:red;">(*)</strong></label>
                                            <div class="d-flex align-items-center">
                                                <div id="marcaIconPreview" class="mr-3">
                                                    <div id="marcaIconBox" style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #3b82f6 0%, #3b82f6dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                        <span id="marcaIniciales">--</span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="nombre" id="nombreMarca"
                                                    placeholder="Por ejemplo, Toyota" autocomplete="off"
                                                    value="{{ old('nombre') }}" required>
                                            </div>
                                            <small class="form-text text-muted">Las iniciales se actualizarán automáticamente</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">País de Origen <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="text" name="pais_origen" placeholder="País de Origen"
                                                class="form-control" autocomplete="off" value="{{ old('pais_origen') }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Logo de la marca --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><i class="fas fa-image text-info mr-1"></i>Logo de la Marca</label>
                                            <div class="d-flex align-items-center">
                                                <div id="imagenPreview" class="mr-3" style="display: none;">
                                                    <img id="imagenPreviewImg" src="" alt="Vista previa" 
                                                         style="width: 80px; height: 80px; border-radius: 8px; object-fit: contain; box-shadow: 0 2px 4px rgba(0,0,0,0.1); background: #f8fafc;">
                                                </div>
                                                <div id="imagenPlaceholder" class="mr-3">
                                                    <div style="width: 80px; height: 80px; border-radius: 8px; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 24px;">
                                                        <i class="fas fa-car"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" name="imagen" id="imagenInput" class="form-control-file" accept="image/*">
                                                    <small class="form-text text-muted">Sube el logo de la marca. Formatos: JPG, PNG</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="estado" value="1">
                                <input type="hidden" class="form-control" name="registrado_por"
                                    value="{{ Auth::user()->name }}">

                                <!-- <input type="hidden" class="form-control" name="estado" value="1">
                                {{-- Eliminado campo registrado_por porque ahora se asigna automáticamente en el controlador --}} -->
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('marcas.index') }}"
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
        var colors = ['#ef4444', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'];
        
        $('#nombreMarca').on('input', function() {
            var nombre = $(this).val().toUpperCase();
            var iniciales = nombre.length >= 2 ? nombre.substring(0, 2) : (nombre.length == 1 ? nombre + '-' : '--');
            var colorIndex = nombre.length > 0 ? nombre.charCodeAt(0) % colors.length : 0;
            var bgColor = colors[colorIndex];
            
            $('#marcaIniciales').text(iniciales);
            $('#marcaIconBox').css('background', 'linear-gradient(135deg, ' + bgColor + ' 0%, ' + bgColor + 'dd 100%)');
        });
        
        // Vista previa de imagen
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