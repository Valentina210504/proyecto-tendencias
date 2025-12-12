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
        
        $totalVehiculos = \App\Models\Vehiculo::count();

        $conductoresActivos = \App\Models\Conductor::where('estado', 'activo')->count();

        $viajesDelMes = \App\Models\Viaje::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $viajesData = [];
        $viajesMeses = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $viajesMeses[] = $date->format('M');
            $viajesData[] = \App\Models\Viaje::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

 
        $vehiculosMayorKilometraje = \App\Models\Vehiculo::orderByDesc('kilometraje')
            ->take(5)
            ->with('marca') 
            ->get();

       
        $gastoCombustibleMes = \App\Models\Recarga_Combustible::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('costo_total');
        
       
        $licenciasPorVencer = \App\Models\Licencia::where('fecha_vencimiento', '>', now())
            ->where('fecha_vencimiento', '<=', now()->addDays(30))
            ->get();

      
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