<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recarga_Combustible;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'cantidad_litros' => 'required|string|max:255',
                'precio_litro' => 'required|string|max:255',
                'costo_total' => 'required|string|max:255',
                'estacion_servicio' => 'required|string|max:255',
                'estado' => 'required|string|in:activo,inactivo'
            ]);
            
            $validated['registrado_por'] = auth()->user()->name;
            
            $recarga_combustible = Recarga_Combustible::create($validated);
            
            return redirect()->route('recarga_combustibles.index')
                ->with('successMsg', 'Recarga_Combustible creada exitosamente.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
                
        } catch (QueryException $e) {
            Log::error('Error al crear la recarga comburtible: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la recarga combustible en la base de datos.')
                ->withInput();
                
        } catch (\Exception $e) {
            Log::error('Error inesperado al crear la recarga combustible: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error inesperado al crear la recarga combustible')
                ->withInput();
        }
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
        //
    }

    public function update(Request $request, string $id)
    {
        //
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