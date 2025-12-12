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
        $data = $request->all();
        
        // Manejar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $path = public_path('images/empresas');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imagen->move($path, $nombreImagen);
            $data['imagen'] = 'images/empresas/' . $nombreImagen;
        }
        
        $empresa = Empresa::create($data);
        return redirect()->route('empresas.index')->with('successMsg', 'Empresa creada con éxito');
    }

    public function cambioestadoempresa($id)
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
        $empresa = Empresa::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    public function update(EmpresaRequest $request, string $id)
    {
        try {
            $empresa = Empresa::findOrFail($id);
            $data = $request->all();
            
            // Manejar la imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($empresa->imagen && file_exists(public_path($empresa->imagen))) {
                    unlink(public_path($empresa->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/empresas');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/empresas/' . $nombreImagen;
            }
            
            $empresa->update($data);
            
            return redirect()->route('empresas.index')->with('successMsg', 'Empresa actualizada con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar la empresa: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar la empresa.')->withInput();
        }
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