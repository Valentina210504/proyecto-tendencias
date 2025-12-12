@extends('layouts.app')

@section('title', 'Editar Tipo de Vehículo')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-truck mr-2"></i>Editar Tipo de Vehículo</h1>
                    <a href="{{ route('tipo_vehiculos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-edit mr-2"></i>Editar Tipo de Vehículo - {{ $tipo_vehiculo->nombre }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('tipo_vehiculos.update', $tipo_vehiculo->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- Mensajes de error --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5><i class="icon fas fa-ban"></i> Por favor corrige los siguientes errores:
                                            </h5>
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="row">
                                        {{-- Nombre --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    <i class="fas fa-tag text-primary mr-1"></i>
                                                    Nombre <strong style="color:red;">(*)</strong>
                                                </label>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $tipoNombre = strtolower($tipo_vehiculo->nombre);
                                                        $iconMapPHP = [
                                                            'automóvil' => 'fa-car', 'automovil' => 'fa-car', 'auto' => 'fa-car', 'carro' => 'fa-car',
                                                            'sedan' => 'fa-car-side', 'suv' => 'fa-car-side',
                                                            'camioneta' => 'fa-truck-pickup', 'pickup' => 'fa-truck-pickup',
                                                            'camión' => 'fa-truck', 'camion' => 'fa-truck',
                                                            'bus' => 'fa-bus', 'autobús' => 'fa-bus', 'autobus' => 'fa-bus',
                                                            'van' => 'fa-shuttle-van', 'furgoneta' => 'fa-shuttle-van', 'minivan' => 'fa-shuttle-van',
                                                            'motocicleta' => 'fa-motorcycle', 'moto' => 'fa-motorcycle',
                                                            'taxi' => 'fa-taxi', 'tractor' => 'fa-tractor',
                                                        ];
                                                        $iconInicial = 'fa-truck';
                                                        foreach ($iconMapPHP as $key => $value) {
                                                            if (strpos($tipoNombre, $key) !== false) {
                                                                $iconInicial = $value;
                                                                break;
                                                            }
                                                        }
                                                        $colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
                                                        $colorIndex = ord(strtoupper(substr($tipo_vehiculo->nombre, 0, 1))) % count($colors);
                                                        $bgColor = $colors[$colorIndex];
                                                    @endphp
                                                    <div id="tipoIconPreview" class="mr-3">
                                                        <div id="tipoIconBox" style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, {{ $bgColor }} 0%, {{ $bgColor }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                            <i id="tipoIcon" class="fas {{ $iconInicial }}"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control @error('nombre') is-invalid @enderror"
                                                        name="nombre" id="nombre" value="{{ old('nombre', $tipo_vehiculo->nombre) }}"
                                                        placeholder="Ej: Sedán, Bus, Camión, SUV, Van" required>
                                                </div>
                                                <small class="form-text text-muted">El ícono cambiará automáticamente según el tipo</small>
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Descripción --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">
                                                    <i class="fas fa-align-left text-info mr-1"></i>
                                                    Descripción <strong style="color:red;">(*)</strong>
                                                </label>
                                                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                                                    rows="3" placeholder="Ej: Vehículo de 4 puertas" required>{{ old('descripcion', $tipo_vehiculo->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Capacidad de Pasajeros --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_pasajero">
                                                    <i class="fas fa-users text-success mr-1"></i>
                                                    Capacidad de Pasajeros <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_pasajero') is-invalid @enderror"
                                                    name="capacidad_pasajero" id="capacidad_pasajero"
                                                    value="{{ old('capacidad_pasajero', $tipo_vehiculo->capacidad_pasajero) }}" placeholder="Ej: 5"
                                                    min="1" required>
                                                @error('capacidad_pasajero')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Capacidad de Carga --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_carga">
                                                    <i class="fas fa-box text-warning mr-1"></i>
                                                    Capacidad de Carga (kg) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_carga') is-invalid @enderror"
                                                    name="capacidad_carga" id="capacidad_carga"
                                                    value="{{ old('capacidad_carga', $tipo_vehiculo->capacidad_carga) }}" placeholder="Ej: 500"
                                                    min="0" required>
                                                @error('capacidad_carga')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Capacidad de Gasolina --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_gasolina">
                                                    <i class="fas fa-gas-pump text-danger mr-1"></i>
                                                    Capacidad de Gasolina (L) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_gasolina') is-invalid @enderror"
                                                    name="capacidad_gasolina" id="capacidad_gasolina"
                                                    value="{{ old('capacidad_gasolina', $tipo_vehiculo->capacidad_gasolina) }}" placeholder="Ej: 50"
                                                    min="0" required>
                                                @error('capacidad_gasolina')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- IMAGEN/LOGO DEL TIPO DE VEHÍCULO --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    <i class="fas fa-image text-info mr-1"></i>
                                                    Logo del Tipo de Vehículo
                                                </label>
                                                
                                                @if($tipo_vehiculo->imagen)
                                                    <div class="mb-3">
                                                        <p class="text-muted mb-2">Imagen actual:</p>
                                                        <img src="{{ asset($tipo_vehiculo->imagen) }}" alt="Imagen actual" 
                                                            style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    </div>
                                                @endif
                                                
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="imagenTipoVehiculo" 
                                                        name="imagen" accept="image/*" onchange="previewImage(event)">
                                                    <label class="custom-file-label" for="imagenTipoVehiculo">
                                                        {{ $tipo_vehiculo->imagen ? 'Cambiar imagen...' : 'Seleccionar imagen...' }}
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                                
                                                {{-- Preview --}}
                                                <div id="imagePreview" class="mt-3" style="display: none;">
                                                    <p class="text-muted mb-2">Nueva imagen:</p>
                                                    <img id="preview" src="" alt="Preview" 
                                                        style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campo oculto --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $tipo_vehiculo->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $tipo_vehiculo->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('tipo_vehiculos.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Tipo de Vehículo
                                        </button>
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
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        const label = document.querySelector('.custom-file-label');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
            label.textContent = input.files[0].name;
        }
    }

    $(document).ready(function() {
        var iconMap = {
            'automóvil': 'fa-car', 'automovil': 'fa-car', 'auto': 'fa-car', 'carro': 'fa-car',
            'sedan': 'fa-car-side', 'suv': 'fa-car-side',
            'camioneta': 'fa-truck-pickup', 'pickup': 'fa-truck-pickup',
            'camión': 'fa-truck', 'camion': 'fa-truck',
            'bus': 'fa-bus', 'autobús': 'fa-bus', 'autobus': 'fa-bus',
            'van': 'fa-shuttle-van', 'furgoneta': 'fa-shuttle-van', 'minivan': 'fa-shuttle-van',
            'motocicleta': 'fa-motorcycle', 'moto': 'fa-motorcycle',
            'taxi': 'fa-taxi', 'tractor': 'fa-tractor'
        };
        
        var colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
        
        $('#nombre').on('input', function() {
            var nombre = $(this).val().toLowerCase();
            var icon = 'fa-truck';
            
            for (var key in iconMap) {
                if (nombre.indexOf(key) !== -1) {
                    icon = iconMap[key];
                    break;
                }
            }
            
            var colorIndex = nombre.length > 0 ? nombre.charCodeAt(0) % colors.length : 0;
            var bgColor = colors[colorIndex];
            
            $('#tipoIcon').removeClass().addClass('fas ' + icon);
            $('#tipoIconBox').css('background', 'linear-gradient(135deg, ' + bgColor + ' 0%, ' + bgColor + 'dd 100%)');
        });
    });
</script>
@endpush