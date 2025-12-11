<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContratoRequest;
use App\Models\Conductor;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::all();
        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        return view('contratos.create');
    }

    public function store(ContratoRequest $request)
    {
        $contrato = Contrato::create($request->all());
        return redirect()->route('contratos.index')->with('successMsg', 'Contrato creado con éxito');
    }

    public function cambioestadocontrato($id)
    {
        try {
            $contrato = Contrato::findOrFail($id);
            Log::info("Intento de cambio de estado contrato ID: {$id}. Estado actual: {$contrato->estado}");
            
            // Toggle: activo <-> inactivo
            // Normalizar a minúsculas por si acaso
            $estadoActual = strtolower($contrato->estado);
            
            $contrato->estado = ($estadoActual === 'activo') ? 'inactivo' : 'activo';
            
            $contrato->save();
            Log::info("Nuevo estado contrato ID: {$id}: {$contrato->estado}");
    
            return response()->json([
                'success' => true,
                'nuevo_estado' => $contrato->estado
            ]);
        } catch (Exception $e) {
            Log::error('Error al cambiar estado contrato: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error del servidor'], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $contrato = Contrato::findOrFail($id);
        $conductores = Conductor::all();
        return view('contratos.edit', compact('contrato', 'conductores'));
    }

    public function update(ContratoRequest $request, string $id)
    {
        try {
            $contrato = Contrato::findOrFail($id);
            $contrato->update($request->all());
            
            return redirect()->route('contratos.index')->with('successMsg', 'Contrato actualizado con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar el contrato: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar el contrato.')->withInput();
        }
    }

    public function destroy(Contrato $contrato)
    {
        try {
            $contrato->delete();
            return redirect()->route('contratos.index')->with('successMsg', 'El contrato se eliminó exitosamente');

        } catch (QueryException $e) {
            Log::error('Error al eliminar el contrato: ' . $e->getMessage());
            return redirect()->route('contratos.index')
                ->withErrors('El contrato que desea eliminar tiene información relacionada. Comuníquese con el Administrador');

        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el contrato: ' . $e->getMessage());
            return redirect()->route('contratos.index')
                ->withErrors('Ocurrió un error inesperado al eliminar el contrato. Comuníquese con el Administrador');
        }
    }
}