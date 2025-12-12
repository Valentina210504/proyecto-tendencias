<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recarga_Combustible;
use App\Models\Vehiculo;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Recarga_CombustibleRequest;

class Recarga_CombustibleController extends Controller
{
    public function index()
    {
        $recarga_combustibles= Recarga_Combustible::all();
        return view('recarga_combustibles.index', compact('recarga_combustibles'));
    }

    public function create()
    {
        return view('recarga_combustibles.create');
    }

    public function store(Recarga_CombustibleRequest $request)
    {
        $data = $request->all();
        
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $path = public_path('images/recarga_combustibles');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imagen->move($path, $nombreImagen);
            $data['imagen'] = 'images/recarga_combustibles/' . $nombreImagen;
            Log::info('Imagen guardada en: ' . $data['imagen']);
        }
        
        $recarga_combustible = Recarga_Combustible::create($data);
        return redirect()->route('recarga_combustibles.index')->with('successMsg', 'Recarga Combustible creada con exito');
    }

public function cambioestadorecarga_combustible($id)
{
    $recarga = Recarga_Combustible::findOrFail($id);
    
    $recarga->estado = ($recarga->estado === 'activo') ? 'inactivo' : 'activo';
    $recarga->save();

    return response()->json([
        'success' => true,
        'nuevo_estado' => $recarga->estado === 'activo' ? true : false
    ]);
}

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $recarga_combustible = Recarga_Combustible::findOrFail($id);
        $vehiculos = Vehiculo::where('estado', 1)->get(); // Solo vehículos activos
        return view('recarga_combustibles.edit', compact('recarga_combustible', 'vehiculos'));
    }

    public function update(Recarga_CombustibleRequest $request, string $id)
    {
        try {
            $recarga_combustible = Recarga_Combustible::findOrFail($id);
            $data = $request->all();
            
          
            if ($request->hasFile('imagen')) {
                
                if ($recarga_combustible->imagen && file_exists(public_path($recarga_combustible->imagen))) {
                    unlink(public_path($recarga_combustible->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/recarga_combustibles');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/recarga_combustibles/' . $nombreImagen;
                Log::info('Imagen actualizada: ' . $data['imagen']);
            }
            
            $recarga_combustible->update($data);
            
            return redirect()->route('recarga_combustibles.index')->with('successMsg', 'Recarga actualizada con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar la recarga: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar la recarga.')->withInput();
        }
    }

    public function destroy(Recarga_Combustible $recarga_combustible)
    {
        try {
            $recarga_combustible->delete();
            return redirect()->route('recarga_combustibles.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la recarga combustible: ' . $e->getMessage());
            return redirect()->route('recarga_combustibles.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la recarga combustible: ' . $e->getMessage());
            return redirect()->route('recarga_combustibles.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}