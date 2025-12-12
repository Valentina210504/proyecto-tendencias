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
        try {
            // Asignación manual para evitar que cambien estado o registrado_por desde el form
            $data = $request->all();
            $data['estado'] = 'activo';
            $data['registrado_por'] = Auth::user()->name;
            
            // Manejar la subida de imagen
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/rutas');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/rutas/' . $nombreImagen;
                Log::info('Imagen guardada en: ' . $data['imagen']);
            }

            Ruta::create($data);

            return redirect()->route('rutas.index')->with('successMsg', 'Ruta creada con éxito');
        } catch (Exception $e) {
            Log::error('Error al crear ruta: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('errorMsg', 'Error al crear la ruta: ' . $e->getMessage());
        }
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
        try {
            $ruta = Ruta::findOrFail($id);
            
            $data = $request->all();
            unset($data['estado'], $data['registrado_por']); // nunca se deben editar
            
            // Manejar la subida de imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($ruta->imagen && file_exists(public_path($ruta->imagen))) {
                    unlink(public_path($ruta->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/rutas');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/rutas/' . $nombreImagen;
                Log::info('Imagen actualizada: ' . $data['imagen']);
            }

            $ruta->update($data);

            return redirect()->route('rutas.index')->with('successMsg', 'Ruta actualizada con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar ruta: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar la ruta.')->withInput();
        }
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