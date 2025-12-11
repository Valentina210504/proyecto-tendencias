<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RutaRequest;
use Illuminate\Support\Facades\Auth;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::all();
        return view('rutas.index', compact('rutas'));
    }

    public function create()
    {
        return view('rutas.create');
    }

    public function store(RutaRequest $request)
    {
        // Asignación manual para evitar que cambien estado o registrado_por desde el form
        $data = $request->all();
        $data['estado'] = 'activo';
        $data['registrado_por'] = Auth::user()->name;

        Ruta::create($data);

        return redirect()->route('rutas.index')->with('successMsg', 'Ruta creada con éxito');
    }

    public function cambioestadoruta($id)
    {
        $ruta = Ruta::findOrFail($id);
        
        $ruta->estado = $ruta->estado === 'activo' ? 'inactivo' : 'activo';
        $ruta->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $ruta->estado === 'activo'  // ← Devuelve booleano
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $ruta = Ruta::findOrFail($id);
        return view('rutas.edit', compact('ruta'));
    }

    public function update(RutaRequest $request, string $id)
    {
        $ruta = Ruta::findOrFail($id);
        
        $data = $request->all();
        unset($data['estado'], $data['registrado_por']); // nunca se deben editar

        $ruta->update($data);

        return redirect()->route('rutas.index')->with('successMsg', 'Ruta actualizada con éxito');
    }

    public function destroy(Ruta $ruta)
    {
        try {
            $ruta->delete();
            return redirect()->route('rutas.index')->with('successMsg', 'La ruta se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la ruta: ' . $e->getMessage());
            return redirect()->route('rutas.index')->withErrors('La ruta tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la ruta: ' . $e->getMessage());
            return redirect()->route('rutas.index')->withErrors('Ocurrió un error inesperado. Comuníquese con el Administrador');
        }
    }
}