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
        $data = $request->all();
        
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $path = public_path('images/conductores');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imagen->move($path, $nombreImagen);
            $data['imagen'] = 'images/conductores/' . $nombreImagen;
        }
        
        $conductor = Conductor::create($data);
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
        $conductor = Conductor::findOrFail($id);
        return view('conductores.edit', compact('conductor'));
    }

    public function update(ConductorRequest $request, string $id)
    {
        try {
            $conductor = Conductor::findOrFail($id);
            $data = $request->all();
            
            
            if ($request->hasFile('imagen')) {
                
                if ($conductor->imagen && file_exists(public_path($conductor->imagen))) {
                    unlink(public_path($conductor->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/conductores');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/conductores/' . $nombreImagen;
            }
            
            $conductor->update($data);
            
            return redirect()->route('conductores.index')->with('successMsg', 'Conductor actualizado con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar el conductor: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar el conductor.')->withInput();
        }
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