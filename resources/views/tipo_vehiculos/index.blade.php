@extends('layouts.app')

@section('title','Listado De Tipos de Vehículos')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-truck mr-2"></i>Tipos de Vehículos</h1>
                <a href="{{ route('tipo_vehiculos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nuevo Tipo de Vehículo
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Tipos de Vehículos
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar tipo de vehículo...">
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
                                            <th>
                                                <i class="fas fa-truck text-muted"></i> Nombre
                                            </th>
                                            <th>
                                                <i class="fas fa-align-left text-muted"></i> Descripción
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-users text-muted"></i> Cap. Pasajeros
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-boxes text-muted"></i> Cap. Carga (kg)
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-gas-pump text-muted"></i> Cap. Gasolina (L)
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
                                        @foreach($tipo_vehiculos as $tipo_vehiculo)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $tipo_vehiculo->id }}
                                            </td>
                                            <td>
                                                <span
                                                    class="font-weight-bold text-dark">{{ $tipo_vehiculo->nombre }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary">{{ Str::limit($tipo_vehiculo->descripcion, 40) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-primary px-2 py-1">
                                                    <i
                                                        class="fas fa-user mr-1"></i>{{ $tipo_vehiculo->capacidad_pasajero }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning px-2 py-1">
                                                    {{ number_format($tipo_vehiculo->capacidad_carga, 2) }} kg
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info px-2 py-1">
                                                    <i
                                                        class="fas fa-gas-pump mr-1"></i>{{ number_format($tipo_vehiculo->capacidad_gasolina, 2) }}
                                                    L
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $tipo_vehiculo->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($tipo_vehiculo->estado)
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
                                                <input data-type="tipo_vehiculos" data-id="{{ $tipo_vehiculo->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $tipo_vehiculo->estado ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tipo_vehiculos.edit', $tipo_vehiculo->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('tipo_vehiculos.destroy', $tipo_vehiculo) }}"
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