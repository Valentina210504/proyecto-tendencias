@extends('layouts.app')

@section('title','Listado De Rutas')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-route mr-2"></i>Rutas de Transporte</h1>
                <a href="{{ route('rutas.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nueva Ruta
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Rutas
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar ruta...">
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
                                                <i class="fas fa-image text-muted"></i>
                                            </th>
                                            <th>
                                                <i class="fas fa-route text-muted"></i> Nombre Ruta
                                            </th>
                                            <th>
                                                <i class="fas fa-align-left text-muted"></i> Descripción
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-road text-muted"></i> Distancia (km)
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-clock text-muted"></i> Tiempo Estimado
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-money-bill-wave text-muted"></i> Costo Peaje
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-tag text-muted"></i> Precio Viaje
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
                                        @foreach($rutas as $ruta)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $ruta->id }}
                                            </td>
                                            <td class="text-center">
                                                @if($ruta->imagen && file_exists(public_path($ruta->imagen)))
                                                    {{-- Mostrar imagen subida --}}
                                                    <img src="{{ asset($ruta->imagen) }}" alt="{{ $ruta->nombre_ruta }}" 
                                                        style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 0 auto; display: block;">
                                                @else
                                                    {{-- Mostrar ícono por defecto --}}
                                                    @php
                                                        $colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'];
                                                        $colorIndex = ord(strtoupper(substr($ruta->nombre_ruta, 0, 1))) % count($colors);
                                                        $bgColor = $colors[$colorIndex];
                                                    @endphp
                                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, {{ $bgColor }} 0%, {{ $bgColor }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 0 auto;">
                                                        <i class="fas fa-route"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-dark">{{ $ruta->nombre_ruta }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary">{{ Str::limit($ruta->descripcion, 50) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info px-2 py-1">{{ $ruta->distancia_en_km }}
                                                    km</span>
                                            </td>
                                            <td class="text-center">
                                                <i class="fas fa-clock text-primary mr-1"></i>
                                                {{ $ruta->tiempo_estimado }}
                                            </td>
                                            <td class="text-center">
                                                <span class="text-success font-weight-bold">$
                                                    {{ number_format($ruta->costo_peaje, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-danger font-weight-bold">$
                                                    {{ number_format($ruta->precio, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $ruta->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($ruta->estado == 'activo')
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
                                                <input data-type="rutas" data-id="{{ $ruta->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $ruta->estado == 'activo' ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('rutas.edit', $ruta->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('rutas.destroy', $ruta) }}" method="POST">
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