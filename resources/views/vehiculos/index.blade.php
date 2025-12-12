@extends('layouts.app')

@section('title','Listado De Vehículos')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-car mr-2"></i>Vehículos</h1>
                <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nuevo Vehículo
                </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold mb-0">
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Vehículos
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar vehículo...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center" style="width: 60px;">
                                                <i class="fas fa-hashtag text-muted"></i> ID
                                            </th>
                                            <th class="text-center" style="width: 70px;">
                                                <i class="fas fa-image text-muted"></i> Logo
                                            </th>
                                            <th>
                                                <i class="fas fa-id-card text-muted"></i> Placa
                                            </th>
                                            <th>
                                                <i class="fas fa-tag text-muted"></i> Marca
                                            </th>
                                            <th>
                                                <i class="fas fa-truck text-muted"></i> Tipo Vehículo
                                            </th>
                                            <th>
                                                <i class="fas fa-car text-muted"></i> Modelo
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-calendar text-muted"></i> Año
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-palette text-muted"></i> Color
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-tachometer-alt text-muted"></i> Kilometraje
                                            </th>
                                            <th>
                                                <i class="fas fa-user text-muted"></i> Registrado por
                                            </th>
                                            <th class="text-center" style="width: 120px;">
                                                <i class="fas fa-toggle-on text-muted"></i> Estado
                                            </th>
                                            <th class="text-center" style="width: 140px;">
                                                <i class="fas fa-cog text-muted"></i> Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vehiculos as $vehiculo)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $vehiculo->id }}
                                            </td>
                                            <td class="text-center">
                                                <div style="position: relative; width: 50px; height: 50px; margin: 0 auto;">
                                                    @php
                                                        $marcaNombre = $vehiculo->marca->nombre ?? 'N/A';
                                                        $tipoVehiculo = $vehiculo->tipo_vehiculo->nombre ?? 'car';
                                                        $hasUploadedImage = !empty($vehiculo->imagen) && file_exists(public_path($vehiculo->imagen));
                                                        
                                                        // Imagen local basada en la marca (nombre en minúsculas, sin espacios)
                                                        // Las imágenes deben estar en: public/img/vehiculos/
                                                        // Ejemplo: public/img/vehiculos/toyota.png, public/img/vehiculos/samsung.png
                                                        $marcaSlug = strtolower(str_replace(' ', '-', $marcaNombre));
                                                        $imagenMarca = "img/vehiculos/{$marcaSlug}.png";
                                                        $imagenDefault = "img/vehiculos/default.png";
                                                        
                                                        $hasLocalImage = file_exists(public_path($imagenMarca));
                                                    @endphp
                                                    
                                                    @if($hasUploadedImage)
                                                        
                                                        <img src="{{ asset($vehiculo->imagen) }}" 
                                                             alt="{{ $marcaNombre }} {{ $tipoVehiculo }}" 
                                                             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    @elseif($hasLocalImage)
                                                        {{-- Imagen local de la marca --}}
                                                        <img src="{{ asset($imagenMarca) }}" 
                                                             alt="{{ $marcaNombre }}" 
                                                             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    @else
                                                        
                                                        <img src="{{ asset($imagenDefault) }}" 
                                                             alt="Vehículo" 
                                                             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                       
                                                        <div style="display: none; width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); align-items: center; justify-content: center; color: white; font-size: 20px;">
                                                            <i class="fas fa-car"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-dark">{{ $vehiculo->placa }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary">{{ $vehiculo->marca->nombre ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-info px-2 py-1">{{ $vehiculo->tipo_vehiculo->nombre ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark">{{ $vehiculo->modelo }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge badge-secondary px-2 py-1">{{ $vehiculo->año }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-light border px-2 py-1">
                                                    <i class="fas fa-circle mr-1"
                                                        style="color: {{ $vehiculo->color }};"></i>
                                                    {{ ucfirst($vehiculo->color) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-primary font-weight-bold">{{ number_format($vehiculo->kilometraje, 0, ',', '.') }}
                                                    km</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $vehiculo->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($vehiculo->estado)
                                                <span class="badge badge-success px-3 py-2" style="cursor: pointer;"
                                                    title="Clic para cambiar estado">
                                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                                </span>
                                                @else
                                                <span class="badge badge-danger px-3 py-2" style="cursor: pointer;"
                                                    title="Clic para cambiar estado">
                                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                                </span>
                                                @endif
                                                <input data-type="vehiculos" data-id="{{ $vehiculo->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $vehiculo->estado ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('vehiculos.destroy', $vehiculo) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection