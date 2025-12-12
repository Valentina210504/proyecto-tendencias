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
        try {
            $data = $request->all();
            
            // Manejar la subida de imagen
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/tipo_vehiculos');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/tipo_vehiculos/' . $nombreImagen;
                Log::info('Imagen guardada en: ' . $data['imagen']);
            }
            
            $tipo_vehiculo = Tipo_Vehiculo::create($data);
            return redirect()->route('tipo_vehiculos.index')->with('successMsg', 'Tipo de Vehículo creado con éxito');
        } catch (Exception $e) {
            Log::error('Error al crear tipo de vehículo: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('errorMsg', 'Error al crear el tipo de vehículo: ' . $e->getMessage());
        }
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
        $tipo_vehiculo = Tipo_Vehiculo::findOrFail($id);
        return view('tipo_vehiculos.edit', compact('tipo_vehiculo'));
    }

    public function update(Tipo_VehiculoRequest $request, string $id)
    {
        try {
            $tipo_vehiculo = Tipo_Vehiculo::findOrFail($id);
            $data = $request->all();
            
            // Manejar la subida de imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($tipo_vehiculo->imagen && file_exists(public_path($tipo_vehiculo->imagen))) {
                    unlink(public_path($tipo_vehiculo->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/tipo_vehiculos');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/tipo_vehiculos/' . $nombreImagen;
                Log::info('Imagen actualizada: ' . $data['imagen']);
            }
            
            $tipo_vehiculo->update($data);
            
            return redirect()->route('tipo_vehiculos.index')->with('successMsg', 'Tipo de Vehículo actualizado con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar el tipo de vehículo: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar el tipo de vehículo.')->withInput();
        }
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