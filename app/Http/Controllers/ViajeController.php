<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Vehiculo;
use App\Models\Conductor;
use App\Models\Ruta;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ViajeRequest;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::all();
        return view('viajes.index', compact('viajes'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::orderBy('placa')->get();
        $conductores = Conductor::orderBy('nombre')->get();
        $rutas = Ruta::orderBy('nombre_ruta')->get();

        return view('viajes.create', compact('vehiculos', 'conductores', 'rutas'));
    }

        public function store(ViajeRequest $request)
        {
            
            $request['tiempo_estimado'] = now()->format('Y-m-d') . ' ' . $request->tiempo_estimado;
      
            if (!$request->filled('costo_total')) {
                $request->merge(['costo_total' => 0]);
            }

            Viaje::create($request->all());

            return redirect()->route('viajes.index')->with('successMsg', 'Viaje creado con éxito');
        }


    public function cambioestadoviaje($id)
    {
        $viaje = Viaje::findOrFail($id);
        $viaje->estado = !$viaje->estado;
        $viaje->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $viaje->estado
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $viaje = Viaje::findOrFail($id);
        $vehiculos = Vehiculo::where('estado', 1)->get();
        $conductores = Conductor::where('estado', 'activo')->get();
        $rutas = Ruta::where('estado', 'activo')->get();

        return view('viajes.edit', compact('viaje', 'vehiculos', 'conductores', 'rutas'));
    }

    public function update(ViajeRequest $request, string $id)
    {
        try {
            $data = $request->all();
            $viaje = Viaje::findOrFail($id);
            $viaje->update($data);

            return redirect()->route('viajes.index')->with('successMsg', 'Viaje actualizado con éxito');

        } catch (Exception $e) {
            Log::error('Error al actualizar el viaje: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar el viaje.')->withInput();
        }
    }

    public function destroy(Viaje $viaje)
    {
        try {
            $viaje->delete();
            return redirect()->route('viajes.index')->with('successMsg', 'El viaje se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el viaje: ' . $e->getMessage());
            return redirect()->route('viajes.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el viaje: ' . $e->getMessage());
            return redirect()->route('viajes.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}