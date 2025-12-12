@extends('layouts.app')

@section('title','Listado De Viajes')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-map-marked-alt mr-2"></i>Viajes</h1>
                <a href="{{ route('viajes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nuevo Viaje
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Viajes
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar viaje...">
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
                                                <i class="fas fa-image text-muted"></i> Imagen
                                            </th>
                                            <th>
                                                <i class="fas fa-car text-muted"></i> Vehículo (Placa)
                                            </th>
                                            <th>
                                                <i class="fas fa-user-tie text-muted"></i> Conductor
                                            </th>
                                            <th>
                                                <i class="fas fa-route text-muted"></i> Ruta
                                            </th>
                                            <th>
                                                <i class="fas fa-align-left text-muted"></i> Descripción
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-road text-muted"></i> Recorrido
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-clock text-muted"></i> Tiempo Estimado
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-dollar-sign text-muted"></i> Costo Total
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
                                        @foreach($viajes as $viaje)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $viaje->id }}
                                            </td>
                                            <td class="text-center">
                                                <div style="position: relative; width: 50px; height: 50px; margin: 0 auto;">
                                                    @php
                                                        $vehiculo = $viaje->vehiculo;
                                                        $marcaNombre = $vehiculo->marca->nombre ?? 'N/A';
                                                        $hasUploadedImage = $vehiculo && !empty($vehiculo->imagen) && file_exists(public_path($vehiculo->imagen));
                                                        
                                                        // Imagen local basada en la marca
                                                        $marcaSlug = strtolower(str_replace(' ', '-', $marcaNombre));
                                                        $imagenMarca = "img/vehiculos/{$marcaSlug}.png";
                                                        $hasLocalImage = file_exists(public_path($imagenMarca));
                                                    @endphp
                                                    
                                                    @if($hasUploadedImage)
                                                        <img src="{{ asset($vehiculo->imagen) }}" 
                                                             alt="{{ $marcaNombre }}" 
                                                             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    @elseif($hasLocalImage)
                                                        <img src="{{ asset($imagenMarca) }}" 
                                                             alt="{{ $marcaNombre }}" 
                                                             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    @else
                                                        <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                            <i class="fas fa-car"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fas fa-car mr-1 text-primary"></i>
                                                    {{ $viaje->vehiculo->placa ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">
                                                    <i class="fas fa-user mr-1"></i>
                                                    {{ $viaje->conductor->nombre ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info px-2 py-1">
                                                    <i class="fas fa-route mr-1"></i>
                                                    {{ $viaje->ruta->nombre_ruta ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary">{{ Str::limit($viaje->descripcion, 30) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark">{{ $viaje->recorrido }}</span>
                                            </td>
                                            <td class="text-center">
                                                <i class="fas fa-clock text-warning mr-1"></i>
                                                {{ $viaje->tiempo_estimado }}
                                            </td>
                                            <td class="text-center">
                                                <span class="text-success font-weight-bold">$
                                                    {{ number_format($viaje->costo_total, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $viaje->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($viaje->estado)
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
                                                <input data-type="viajes" data-id="{{ $viaje->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $viaje->estado ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('viajes.edit', $viaje->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('viajes.destroy', $viaje) }}" method="POST">
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