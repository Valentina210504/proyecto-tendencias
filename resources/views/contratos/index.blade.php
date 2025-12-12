@extends('layouts.app')

@section('title','Listado de Contratos')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-file-contract mr-2"></i>Contratos</h1>
                <a href="{{ route('contratos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Nuevo Contrato
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
                                    <i class="fas fa-list mr-2 text-primary"></i>Listado de Contratos
                                </h3>
                                <div class="search-box" style="width: 300px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchTable" class="form-control border-left-0"
                                            placeholder="Buscar contrato...">
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
                                                <i class="fas fa-calendar-alt text-muted"></i> Fecha Inicio
                                            </th>
                                            <th>
                                                <i class="fas fa-calendar-times text-muted"></i> Fecha Final
                                            </th>
                                            <th>
                                                <i class="fas fa-dollar-sign text-muted"></i> Salario
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-toggle-on text-muted"></i> Estado
                                            </th>
                                            <th>
                                                <i class="fas fa-user text-muted"></i> Registrado por
                                            </th>
                                            <th class="text-center" style="width: 140px;">
                                                <i class="fas fa-cog text-muted"></i> Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contratos as $contrato)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">
                                                {{ $contrato->id }}
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $colors = ['#8b5cf6', '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#ec4899'];
                                                    $colorIndex = $contrato->id % count($colors);
                                                    $bgColor = $colors[$colorIndex];
                                                @endphp
                                                <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, {{ $bgColor }} 0%, {{ $bgColor }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 0 auto;">
                                                    <i class="fas fa-file-contract"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark font-weight-bold">{{ $contrato->fecha_inicio }}</span>
                                            </td>
                                            <td>
                                                @if($contrato->fecha_final)
                                                <span class="text-secondary">{{ $contrato->fecha_final }}</span>
                                                @else
                                                <span class="text-muted">Sin definir</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="text-success font-weight-bold">${{ number_format($contrato->salario, 0, ',', '.') }}</span>
                                            </td>

                                            <td class="text-center">
                                                @if($contrato->estado === 'activo')
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
                                                <input data-type="contratos" data-id="{{ $contrato->id }}"
                                                    class="toggle-class d-none" type="checkbox"
                                                    {{ $contrato->estado === 'activo' ? 'checked' : '' }}>
                                            </td>

                                            <td>
                                                <span class="text-secondary">{{ $contrato->registrado_por }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('contratos.edit', $contrato->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form class="d-inline delete-form"
                                                        action="{{ route('contratos.destroy', $contrato) }}"
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