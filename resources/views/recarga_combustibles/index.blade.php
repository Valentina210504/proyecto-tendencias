@extends('layouts.app')

@section('title','Listado De Recarga Combustible')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-gas-pump mr-2"></i>Recargas de Combustible</h1>
                <a href="{{ route('recarga_combustibles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nueva Recarga
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Recargas
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar recarga...">
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
                                            <th class="text-center">
                                                <i class="fas fa-tint text-muted"></i> Litros
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-dollar-sign text-muted"></i> Precio/Litro
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-money-bill-wave text-muted"></i> Costo Total
                                            </th>
                                            <th>
                                                <i class="fas fa-gas-pump text-muted"></i> Estación
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
                                        @foreach($recarga_combustibles as $recarga)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $recarga->id }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info px-3 py-2">
                                                    <i
                                                        class="fas fa-tint mr-1"></i>{{ number_format($recarga->cantidad_litros, 2) }}
                                                    L
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-primary font-weight-bold">
                                                    ${{ number_format($recarga->precio_litro, 2) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success px-3 py-2">
                                                    <i
                                                        class="fas fa-dollar-sign mr-1"></i>${{ number_format($recarga->costo_total, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                                {{ $recarga->estacion_servicio }}
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $recarga->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($recarga->estado == 1 || $recarga->estado == 'activo')
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
                                                <input data-type="recarga_combustibles" data-id="{{ $recarga->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ ($recarga->estado == 1 || $recarga->estado == 'activo') ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('recarga_combustibles.edit', $recarga->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('recarga_combustibles.destroy', $recarga) }}"
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