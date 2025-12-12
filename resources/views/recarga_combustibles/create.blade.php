@extends('layouts.app')

@section('title','Crear Recarga Combustible')

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
                        <form method="POST" action="{{ route('recarga_combustibles.store') }}">
                            @csrf
                            <div class="card-body">
                                {{-- Mensaje de error si existe --}}
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
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cantidad de Litros <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="cantidad_litros"
                                                placeholder="Ejemplo: 50.00" autocomplete="off"
                                                value="{{ old('cantidad_litros') }}" required min="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Precio por Litro <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="precio_litro"
                                                placeholder="Ejemplo: 4.50" autocomplete="off"
                                                value="{{ old('precio_litro') }}" required min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Costo Total <strong
                                                    style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="costo_total"
                                                placeholder="Ejemplo: 225.00" autocomplete="off"
                                                value="{{ old('costo_total') }}" required min="0" readonly>
                                            <small class="form-text text-muted">Se calculará automáticamente</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Estación de Servicio <strong
                                                    style="color:red;">(*)</strong></label>
                                            <div class="d-flex align-items-center">
                                                <div id="estacionIconPreview" class="mr-3">
                                                    <div id="estacionIconBox" style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #ef4444 0%, #ef4444dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                        <i class="fas fa-gas-pump"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="estacion_servicio" id="estacionServicio"
                                                    placeholder="Ejemplo: Shell Zona Norte" autocomplete="off"
                                                    value="{{ old('estacion_servicio') }}" required>
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
                                        <a href="{{ route('recarga_combustibles.index') }}"
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

@push('scripts')
<script>
// Calcular automáticamente el costo total
document.addEventListener('DOMContentLoaded', function() {
    const cantidadLitros = document.querySelector('input[name="cantidad_litros"]');
    const precioLitro = document.querySelector('input[name="precio_litro"]');
    const costoTotal = document.querySelector('input[name="costo_total"]');

    function calcularTotal() {
        const litros = parseFloat(cantidadLitros.value) || 0;
        const precio = parseFloat(precioLitro.value) || 0;
        const total = (litros * precio).toFixed(2);
        costoTotal.value = total;
    }

    cantidadLitros.addEventListener('input', calcularTotal);
    precioLitro.addEventListener('input', calcularTotal);
    
    // Cambiar color del ícono de estación
    var colors = ['#ef4444', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6', '#ec4899'];
    var estacionInput = document.getElementById('estacionServicio');
    
    estacionInput.addEventListener('input', function() {
        var nombre = this.value;
        var colorIndex = nombre.length > 0 ? nombre.charCodeAt(0) % colors.length : 0;
        var bgColor = colors[colorIndex];
        document.getElementById('estacionIconBox').style.background = 'linear-gradient(135deg, ' + bgColor + ' 0%, ' + bgColor + 'dd 100%)';
    });
});
</script>
@endpush
@endsection