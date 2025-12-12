@extends('layouts.app')

@section('title','Crear Vehículo')

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

                        <form method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                {{-- Errores --}}
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

                                {{-- MARCA --}}
                                <div class="form-group">
                                    <label>Marca <strong style="color:red;">(*)</strong></label>
                                    <select name="marca_id" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- TIPO DE VEHÍCULO --}}
                                <div class="form-group">
                                    <label>Tipo de Vehículo <strong style="color:red;">(*)</strong></label>
                                    <select name="tipo_vehiculo_id" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- PLACA --}}
                                <div class="form-group">
                                    <label>Placa <strong style="color:red;">(*)</strong></label>
                                    <input type="text" name="placa" class="form-control" placeholder="Ej: ABC-1234"
                                        required>
                                </div>

                                {{-- MODELO --}}
                                <div class="form-group">
                                    <label>Modelo <strong style="color:red;">(*)</strong></label>
                                    <input type="text" name="modelo" class="form-control" required>
                                </div>

                                {{-- AÑO --}}
                                <div class="form-group">
                                    <label>Año <strong style="color:red;">(*)</strong></label>
                                    <input type="number" name="año" class="form-control" min="1900" max="2099" required>
                                </div>

                                {{-- COLOR --}}
                                <div class="form-group">
                                    <label>Color <strong style="color:red;">(*)</strong></label>
                                    <input type="text" name="color" class="form-control" required>
                                </div>

                                {{-- KILOMETRAJE --}}
                                <div class="form-group">
                                    <label>Kilometraje <strong style="color:red;">(*)</strong></label>
                                    <input type="number" step="0.01" name="kilometraje" class="form-control" required>
                                </div>

                                {{-- IMAGEN/LOGO DEL VEHÍCULO --}}
                                <div class="form-group">
                                    <label>Logo del Vehículo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagenVehiculo" name="imagen" accept="image/*" onchange="previewImage(event)">
                                        <label class="custom-file-label" for="imagenVehiculo">Seleccionar imagen...</label>
                                    </div>
                                    <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                    
                                    {{-- Preview --}}
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    </div>
                                </div>

                                {{-- HIDDEN --}}
                                <input type="hidden" name="estado" value="1">
                                <input type="hidden" name="registrado_por" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                                    </div>

                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('vehiculos.index') }}" class="btn btn-danger btn-block">
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
</script>
@endpush