<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Total Vehículos
        $totalVehiculos = \App\Models\Vehiculo::count();

        // 2. Conductores Activos
        $conductoresActivos = \App\Models\Conductor::where('estado', 'activo')->count();

        // 3. Viajes del Mes (Actual)
        $viajesDelMes = \App\Models\Viaje::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // 4. Gráfico: Viajes por Mes (Últimos 6 meses)
        $viajesData = [];
        $viajesMeses = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $viajesMeses[] = $date->format('M');
            $viajesData[] = \App\Models\Viaje::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        // 5. Vehículos con Mayor Kilometraje (Top 5)
        $vehiculosMayorKilometraje = \App\Models\Vehiculo::orderByDesc('kilometraje')
            ->take(5)
            ->with('marca') // Eager loading marca
            ->get();

        // 6. Gasto Combustible Mes
        $gastoCombustibleMes = \App\Models\Recarga_Combustible::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('costo_total');
        
        // 7. Licencias Por Vencer (Próximos 30 días)
        $licenciasPorVencer = \App\Models\Licencia::where('fecha_vencimiento', '>', now())
            ->where('fecha_vencimiento', '<=', now()->addDays(30))
            ->get();

        // 8. Actividad Reciente (Últimos 5 viajes)
        $actividadReciente = \App\Models\Viaje::latest()->take(5)->get();


        return view('home', compact(
            'totalVehiculos',
            'conductoresActivos',
            'viajesDelMes',
            'viajesData',
            'viajesMeses',
            'vehiculosMayorKilometraje',
            'gastoCombustibleMes',
            'licenciasPorVencer',
            'actividadReciente'
        ));
    }
}
