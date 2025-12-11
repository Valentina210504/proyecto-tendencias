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

    public function edit(string $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $marcas = Marca::where('estado', 1)->get();
        $tipo_vehiculos = Tipo_Vehiculo::where('estado', 1)->get();
        return view('vehiculos.edit', compact('vehiculo', 'marcas', 'tipo_vehiculos'));
    }

    public function update(VehiculoRequest $request, string $id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('imagen')) {
                if ($vehiculo->imagen && file_exists(public_path('uploads/vehiculos/' . $vehiculo->imagen))) {
                    unlink(public_path('uploads/vehiculos/' . $vehiculo->imagen));
                }

                $file = $request->file('imagen');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/vehiculos'), $filename);
                $data['imagen'] = $filename;
            }

            $vehiculo->update($data);
            
            return redirect()->route('vehiculos.index')->with('successMsg', 'Vehículo actualizado con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar el vehículo: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar el vehículo.')->withInput();
        }
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