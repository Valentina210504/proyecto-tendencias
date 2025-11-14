<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conductor;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ConductorRequest;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::all();
        return view('conductores.index', compact('conductores'));
    }

    public function create()
    {
        return view('conductores.create');
    }

    public function store(ConductorRequest $request)
    {
        $conductor = Conductor::create($request->all());
        return redirect()->route('conductores.index')->with('successMsg', 'Conductor creado con éxito');
    }

    public function cambioestadoconductor($id)
    {
        $conductor = Conductor::findOrFail($id);
        $conductor->estado = !$conductor->estado;
        $conductor->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $conductor->estado
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

    public function update(ConductorRequest $request, string $id)
    {
       //
  }

    public function destroy(Conductor $conductor)
    {
        try {
            $conductor->delete();
            return redirect()->route('conductores.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el conductor: ' . $e->getMessage());
            return redirect()->route('conductores.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el conductor: ' . $e->getMessage());
            return redirect()->route('conductores.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}