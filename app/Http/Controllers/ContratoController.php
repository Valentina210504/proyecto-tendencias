<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContratoRequest;

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
        $contrato = Contrato::findOrFail($id);
        
        // Ciclo: activo → suspendido → finalizado → activo
        switch ($contrato->estado) {
            case 'activo':
                $contrato->estado = 'suspendido';
                break;
            case 'suspendido':
                $contrato->estado = 'finalizado';
                break;
            case 'finalizado':
                $contrato->estado = 'activo';
                break;
            default:
                $contrato->estado = 'activo';
        }
        
        $contrato->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $contrato->estado
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