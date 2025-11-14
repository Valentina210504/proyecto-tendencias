@extends('layouts.app')

@section('title','Listado De Conductores')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-id-card mr-2"></i>Conductores</h1>
                <a href="{{ route('conductores.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nuevo Conductor
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Conductores
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar conductor...">
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
                                                <i class="fas fa-user text-muted"></i> Nombre
                                            </th>
                                            <th>
                                                <i class="fas fa-user text-muted"></i> Apellido
                                            </th>
                                            <th>
                                                <i class="fas fa-id-card text-muted"></i> Documento
                                            </th>
                                            <th>
                                                <i class="fas fa-calendar-alt text-muted"></i> Fecha Contrato
                                            </th>
                                            <th>
                                                <i class="fas fa-user-tie text-muted"></i> Registrado por
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
                                        @foreach($conductores as $conductor)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $conductor->id }}
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-dark">{{ $conductor->nombre }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark">{{ $conductor->apellido }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $conductor->documento }}</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar mr-1 text-info"></i>
                                                {{ $conductor->fecha_contrato ? \Carbon\Carbon::parse($conductor->fecha_contrato)->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $conductor->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($conductor->estado == 'activo')
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
                                                <input data-type="conductores" data-id="{{ $conductor->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $conductor->estado ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('conductores.edit', $conductor->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('conductores.destroy', $conductor) }}"
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