<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'pais_origen' => 'required|string|max:255',
                'estado' => 'required|boolean'
            ]);
            
            $validated['registrado_por'] = auth()->user()->name;
            
            $marca = Marca::create($validated);
            
            return redirect()->route('marcas.index')
                ->with('successMsg', 'Marca creada exitosamente.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
                
        } catch (QueryException $e) {
            Log::error('Error al crear la marca: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la marca en la base de datos.')
                ->withInput();
                
        } catch (\Exception $e) {
            Log::error('Error inesperado al crear la marca: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error inesperado al crear la marca.')
                ->withInput();
        }
    }

    public function cambioestadomarca($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->estado = !$marca->estado;
        $marca->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $marca->estado
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

    public function destroy(Marca $marca)
    {
        try {
            $marca->delete();
            return redirect()->route('marcas.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la marca: ' . $e->getMessage());
            return redirect()->route('marcas.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la marca: ' . $e->getMessage());
            return redirect()->route('marcas.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}