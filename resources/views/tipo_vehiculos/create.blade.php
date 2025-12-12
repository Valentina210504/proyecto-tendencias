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

                        <form method="POST" action="{{ route('tipo_vehiculos.store') }}" enctype="multipart/form-data">
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

                                {{-- NOMBRE CON VISTA PREVIA DE ÍCONO --}}
                                <div class="form-group">
                                    <label>Nombre <strong style="color:red;">(*)</strong></label>
                                    <div class="d-flex align-items-center">
                                        <div id="tipoIconPreview" class="mr-3">
                                            <div id="tipoIconBox" style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                <i id="tipoIcon" class="fas fa-truck"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="nombre" id="nombreTipo" class="form-control" value="{{ old('nombre') }}"
                                            placeholder="Ej: Bus, Camión, Moto, SUV, Van" required>
                                    </div>
                                    <small class="form-text text-muted">El ícono cambiará automáticamente según el tipo</small>
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

                                {{-- IMAGEN/LOGO DEL TIPO DE VEHÍCULO --}}
                                <div class="form-group">
                                    <label>Logo del Tipo de Vehículo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagenTipoVehiculo" name="imagen" accept="image/*" onchange="previewImage(event)">
                                        <label class="custom-file-label" for="imagenTipoVehiculo">Seleccionar imagen...</label>
                                    </div>
                                    <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                    
                                    {{-- Preview --}}
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    </div>
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
        
        $('#nombreTipo').on('input', function() {
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