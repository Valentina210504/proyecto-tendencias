@extends('layouts.modern')

@section('content')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endpush

<div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #2d3748; font-weight: 600;">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" style="color: #10b981;">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #6b7280;">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <!-- Total Vehículos Card -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 13px; font-weight: 500;">Total Vehículos</p>
                                        <h2 class="mb-1" style="font-size: 28px; font-weight: 700; color: #1e293b;">
                                            {{ $totalVehiculos ?? 20 }}
                                        </h2>
                                        <small style="color: #10b981; font-size: 12px;">
                                            <i class="fas fa-arrow-up"></i> +2.1% desde la semana pasada
                                        </small>
                                    </div>
                                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                                        <i class="fas fa-car text-white" style="font-size: 22px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conductores Activos Card -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 13px; font-weight: 500;">Total Conductores</p>
                                        <h2 class="mb-1" style="font-size: 28px; font-weight: 700; color: #1e293b;">
                                            {{ $conductoresActivos ?? 0 }}
                                        </h2>
                                        <small style="color: #10b981; font-size: 12px;">
                                            <i class="fas fa-arrow-up"></i> +5.4% desde la semana pasada
                                        </small>
                                    </div>
                                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);">
                                        <i class="fas fa-user-tie text-white" style="font-size: 22px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Viajes del Mes Card -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 13px; font-weight: 500;">Viajes del Mes</p>
                                        <h2 class="mb-1" style="font-size: 28px; font-weight: 700; color: #1e293b;">
                                            {{ $viajesDelMes ?? 0 }}
                                        </h2>
                                        <small style="color: #10b981; font-size: 12px;">
                                            <i class="fas fa-arrow-up"></i> +4.5% desde la semana pasada
                                        </small>
                                    </div>
                                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fas fa-route text-white" style="font-size: 22px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Ganancias Card -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1" style="font-size: 13px; font-weight: 500;">Gasto Combustible</p>
                                        <h2 class="mb-1" style="font-size: 28px; font-weight: 700; color: #1e293b;">
                                            ${{ number_format($gastoCombustibleMes ?? 0, 0) }}
                                        </h2>
                                        <small style="color: #10b981; font-size: 12px;">
                                            <i class="fas fa-arrow-up"></i> +8.4% desde la semana pasada
                                        </small>
                                    </div>
                                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);">
                                        <i class="fas fa-gas-pump text-white" style="font-size: 22px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="mb-0" style="color: #1e293b; font-weight: 600; font-size: 16px;">Resumen de Viajes</h5>
                                        <p class="text-muted mb-0" style="font-size: 13px;">Comparación mensual de viajes</p>
                                    </div>
                                    <button class="btn btn-sm" style="background: #f1f5f9; border: none; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-ellipsis-h" style="color: #64748b;"></i>
                                    </button>
                                </div>
                                <div style="position: relative; height: 250px;">
                                    <canvas id="viajesChart"></canvas>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="mr-4">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #10b981; border-radius: 2px; margin-right: 6px;"></span>
                                        <span style="font-size: 13px; color: #6b7280;">Last 6 days</span>
                                    </div>
                                    <div>
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #d1d5db; border-radius: 2px; margin-right: 6px;"></span>
                                        <span style="font-size: 13px; color: #6b7280;">Last Week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="mb-0" style="color: #1e293b; font-weight: 600; font-size: 16px;">Horarios de Viajes</h5>
                                        <p class="text-muted mb-0" style="font-size: 13px;">Distribución por horario</p>
                                    </div>
                                    <button class="btn btn-sm" style="background: #f1f5f9; border: none; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-ellipsis-h" style="color: #64748b;"></i>
                                    </button>
                                </div>
                                <div style="position: relative; height: 180px;" class="text-center">
                                    <canvas id="vehiculosChart"></canvas>
                                </div>
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <span
                                                style="display: inline-block; width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px;"></span>
                                            <span style="font-size: 13px; color: #6b7280;">Mañana</span>
                                        </div>
                                        <span style="font-size: 14px; font-weight: 600; color: #2d3748;">28%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <span
                                                style="display: inline-block; width: 8px; height: 8px; background: #3b82f6; border-radius: 50%; margin-right: 8px;"></span>
                                            <span style="font-size: 13px; color: #6b7280;">Tarde</span>
                                        </div>
                                        <span style="font-size: 14px; font-weight: 600; color: #2d3748;">40%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span
                                                style="display: inline-block; width: 8px; height: 8px; background: #f59e0b; border-radius: 50%; margin-right: 8px;"></span>
                                            <span style="font-size: 13px; color: #6b7280;">Noche</span>
                                        </div>
                                        <span style="font-size: 14px; font-weight: 600; color: #2d3748;">32%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="mb-0" style="color: #1e293b; font-weight: 600; font-size: 16px;">Vehículos Más Usados</h5>
                                        <p class="text-muted mb-0" style="font-size: 13px;">Top vehículos por kilometraje</p>
                                    </div>
                                    <button class="btn btn-sm" style="background: #f1f5f9; border: none; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-ellipsis-h" style="color: #64748b;"></i>
                                    </button>
                                </div>

                                <div class="list-group list-group-flush">
                                    @forelse($vehiculosMayorKilometraje ?? [] as $index => $vehiculo)
                                    <div
                                        class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3"
                                                style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-car" style="color: #10b981;"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0"
                                                    style="font-size: 14px; color: #2d3748; font-weight: 600;">
                                                    {{ $vehiculo->placa }}
                                                </h6>
                                                <small
                                                    class="text-muted">{{ $vehiculo->marca->nombre ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                        <span
                                            style="font-size: 14px; font-weight: 600; color: #2d3748;">{{ number_format($vehiculo->kilometraje) }}
                                            km</span>
                                    </div>
                                    @empty
                                    <div class="text-center text-muted py-3">No hay datos disponibles</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="mb-0" style="color: #1e293b; font-weight: 600; font-size: 16px;">Gasto en Combustible</h5>
                                        <p class="text-muted mb-0" style="font-size: 13px;">Tendencia últimos 6 días</p>
                                    </div>
                                    <a href="{{ route('recarga_combustibles.index') }}"
                                        class="btn btn-sm" style="background: #f1f5f9; border: none; border-radius: 8px; padding: 6px 12px; text-decoration: none;">
                                        <i class="fas fa-external-link-alt" style="color: #64748b; font-size: 11px;"></i>
                                    </a>
                                </div>

                                <h2 class="mb-3" style="font-size: 36px; font-weight: 700; color: #2d3748;">
                                    ${{ number_format($gastoCombustibleMes ?? 0, 2) }}
                                </h2>

                                <div class="mb-3">
                                    <span class="badge"
                                        style="background: #d1fae5; color: #059669; font-size: 12px; padding: 4px 12px; border-radius: 12px;">
                                        <i class="fas fa-arrow-up"></i> 2.1% vs last week
                                    </span>
                                </div>

                                <div style="position: relative; height: 120px;">
                                    <canvas id="combustibleChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <i class="fas fa-exclamation-triangle" style="color: #f59e0b; font-size: 18px;"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0" style="color: #1e293b; font-weight: 600; font-size: 16px;">Alertas Importantes</h5>
                                            <p class="text-muted mb-0" style="font-size: 13px;">Monitoreo de licencias y actividad</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6
                                            style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 16px;">
                                            Licencias por Vencer</h6>
                                        @forelse($licenciasPorVencer ?? [] as $licencia)
                                        <div class="alert"
                                            style="background: #fef3c7; border: none; border-left: 4px solid #f59e0b; border-radius: 8px; margin-bottom: 12px;">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-id-card mr-3" style="color: #f59e0b;"></i>
                                                <div>
                                                    <strong
                                                        style="color: #78350f;">{{ $licencia->numero_licencia }}</strong>
                                                    <small class="d-block text-muted">Vence el
                                                        {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-check-circle text-success"></i>
                                            No hay licencias por vencer
                                        </div>
                                        @endforelse
                                    </div>

                                    <div class="col-lg-6">
                                        <h6
                                            style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 16px;">
                                            Actividad Reciente</h6>
                                        @forelse($actividadReciente ?? [] as $actividad)
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3"
                                                    style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;">
                                                </div>
                                                <div>
                                                    <strong
                                                        style="color: #2d3748; font-size: 14px;">{{ $actividad->descripcion ?? 'Viaje' }}</strong>
                                                    <small class="d-block text-muted" style="font-size: 12px;">
                                                        {{ \Carbon\Carbon::parse($actividad->created_at)->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle"></i>
                                            No hay actividad reciente
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.font.family = "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
Chart.defaults.responsive = true;
Chart.defaults.maintainAspectRatio = false;


const viajesCtx = document.getElementById('viajesChart');
if (viajesCtx) {
    new Chart(viajesCtx, {
        type: 'bar',
        data: {
            labels: {
                !!json_encode($viajesMeses ?? ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun']) !!
            },
            datasets: [{
                label: 'Last 6 days',
                data: {
                    !!json_encode($viajesData ?? [12, 19, 15, 25, 22, 30]) !!
                },
                backgroundColor: '#10b981',
                borderRadius: 6,
                maxBarThickness: 35
            }, {
                label: 'Last Week',
                data: [10, 15, 12, 20, 18, 25],
                backgroundColor: '#e5e7eb',
                borderRadius: 6,
                maxBarThickness: 35
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 750
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    borderRadius: 8,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    displayColors: true,
                    boxWidth: 12,
                    boxHeight: 12
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9ca3af',
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#9ca3af',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
}


const vehiculosCtx = document.getElementById('vehiculosChart');
if (vehiculosCtx) {
    new Chart(vehiculosCtx, {
        type: 'doughnut',
        data: {
            labels: ['Mañana', 'Tarde', 'Noche'],
            datasets: [{
                data: [28, 40, 32],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 750
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    borderRadius: 8,
                    bodyColor: '#fff',
                    displayColors: true,
                    boxWidth: 12,
                    boxHeight: 12
                }
            }
        }
    });
}


const combustibleCtx = document.getElementById('combustibleChart');
if (combustibleCtx) {
    new Chart(combustibleCtx, {
        type: 'line',
        data: {
            labels: ['01', '02', '03', '04', '05', '06'],
            datasets: [{
                data: [30, 45, 40, 55, 50, 65],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#10b981',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 750
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 8,
                    borderRadius: 6,
                    displayColors: false,
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9ca3af',
                        font: {
                            size: 10
                        }
                    }
                },
                y: {
                    display: false
                }
            }
        }
    });
}
</script>
@endpush
@endsection