<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_Vehiculo;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Tipo_VehiculoRequest;

class Tipo_VehiculoController extends Controller
{
    public function index()
    {
        $tipo_vehiculos = Tipo_Vehiculo::all();
        return view('tipo_vehiculos.index', compact('tipo_vehiculos'));
    }

    public function create()
    {
        return view('tipo_vehiculos.create');
    }

    public function store(Tipo_VehiculoRequest $request)
    {
        $tipo_vehiculo = Tipo_Vehiculo::create($request->all());
        return redirect()->route('tipo_vehiculos.index')->with('successMsg', 'Tipo de Vehículo creado con éxito');
    }

    public function cambioestadotipo_vehiculo($id)  
    {
        $tipo_vehiculo = Tipo_Vehiculo::findOrFail($id);
        $tipo_vehiculo->estado = !$tipo_vehiculo->estado;
        $tipo_vehiculo->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $tipo_vehiculo->estado
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Tipo_Vehiculo $tipo_vehiculo)
    {
        try {
            $tipo_vehiculo->delete();
            return redirect()->route('tipo_vehiculos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el tipo de vehículo: ' . $e->getMessage());
            return redirect()->route('tipo_vehiculos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el tipo de vehículo: ' . $e->getMessage());
            return redirect()->route('tipo_vehiculos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}