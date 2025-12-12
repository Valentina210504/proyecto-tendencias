<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licencia;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LicenciaRequest;

class LicenciaController extends Controller
{
    public function index()
    {
        $licencias = Licencia::all();
        return view('licencias.index', compact('licencias'));
    }

    public function create()
    {
        return view('licencias.create');
    }

    public function store(LicenciaRequest $request)
    {
        $data = $request->all();
        
       
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $path = public_path('images/licencias');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imagen->move($path, $nombreImagen);
            $data['imagen'] = 'images/licencias/' . $nombreImagen;
        }
        
        $licencia = Licencia::create($data);
        return redirect()->route('licencias.index')->with('successMsg', 'Licencia creada con éxito');
    }

    public function cambioestadolicencia($id)
    {
        $licencia = Licencia::findOrFail($id);
        $licencia->estado = !$licencia->estado;
        $licencia->save();

        return response()->json([
            'success' => true,
            'nuevo_estado' => $licencia->estado
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $licencia = Licencia::findOrFail($id);
        return view('licencias.edit', compact('licencia'));
    }

    public function update(LicenciaRequest $request, string $id)
    {
        try {
            $licencia = Licencia::findOrFail($id);
            $data = $request->all();
            
            
            if ($request->hasFile('imagen')) {
                
                if ($licencia->imagen && file_exists(public_path($licencia->imagen))) {
                    unlink(public_path($licencia->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/licencias');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/licencias/' . $nombreImagen;
                Log::info('Imagen actualizada: ' . $data['imagen']);
            }
            
            $licencia->update($data);
            
            return redirect()->route('licencias.index')->with('successMsg', 'Licencia actualizada con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar la licencia: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar la licencia.')->withInput();
        }
    }

    public function destroy(Licencia $licencia)
    {
        try {
            $licencia->delete();
            return redirect()->route('licencias.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la licencia: ' . $e->getMessage());
            return redirect()->route('licencias.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la licencia: ' . $e->getMessage());
            return redirect()->route('licencias.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}