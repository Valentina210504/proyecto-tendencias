<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(EmpresaRequest $request)
    {
        $empresa = Empresa::create($request->all());
        return redirect()->route('empresas.index')->with('successMsg', 'Empresa creada con éxito');
    }

    public function cambioestadomarca($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->estado = !$empresa->estado;
        $empresa->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $empresa->estado
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

    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();
            return redirect()->route('empresas.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la empresa: ' . $e->getMessage());
            return redirect()->route('empresas.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la empresa: ' . $e->getMessage());
            return redirect()->route('empresas.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}