<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Tipo_Vehiculo;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\VehiculoRequest;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
    $marcas = Marca::all();
    $tipos = Tipo_Vehiculo::all();

    return view('vehiculos.create', compact('marcas', 'tipos'));
    }

    public function store(VehiculoRequest $request)
    {
        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')
            ->with('successMsg', 'Vehículo creado con éxito');
    }

    public function cambioestadovehiculo($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->estado = !$vehiculo->estado;
        $vehiculo->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $vehiculo->estado
        ]);
    }

    public function destroy(Vehiculo $vehiculo)
    {
        try {
            $vehiculo->delete();

            return redirect()->route('vehiculos.index')
                ->with('successMsg', 'El vehículo se eliminó exitosamente');

        } catch (QueryException $e) {
            Log::error('Error al eliminar el vehículo: ' . $e->getMessage());
            return redirect()->route('vehiculos.index')
                ->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el vehículo: ' . $e->getMessage());
            return redirect()->route('vehiculos.index')
                ->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}