<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MarcaRequest;

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

    public function store(MarcaRequest $request)
    {
        $data = $request->all();
        
        // Manejar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $path = public_path('images/marcas');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imagen->move($path, $nombreImagen);
            $data['imagen'] = 'images/marcas/' . $nombreImagen;
        }
        
        $marca = Marca::create($data);
        return redirect()->route('marcas.index')->with('successMsg', 'Marca creada con exito');
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
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(MarcaRequest $request, string $id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $data = $request->all();
            
            // Manejar la subida de imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($marca->imagen && file_exists(public_path($marca->imagen))) {
                    unlink(public_path($marca->imagen));
                }
                
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $path = public_path('images/marcas');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $imagen->move($path, $nombreImagen);
                $data['imagen'] = 'images/marcas/' . $nombreImagen;
                Log::info('Imagen actualizada: ' . $data['imagen']);
            }
            
            $marca->update($data);
            
            return redirect()->route('marcas.index')->with('successMsg', 'Marca actualizada con éxito');
        } catch (Exception $e) {
            Log::error('Error al actualizar la marca: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar la marca.')->withInput();
        }
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


        // try {
        //     $validated = $request->validate([
        //         'nombre' => 'required|string|max:255',
        //         'pais_origen' => 'required|string|max:255',
        //         'estado' => 'required|boolean'
        //     ]);
            
        //     $validated['registrado_por'] = auth()->user()->name;
            
        //     $marca = Marca::create($validated);
            
        //     return redirect()->route('marcas.index')
        //         ->with('successMsg', 'Marca creada exitosamente.');
                
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     return redirect()->back()
        //         ->withErrors($e->errors())
        //         ->withInput();
                
        // } catch (QueryException $e) {
        //     Log::error('Error al crear la marca: ' . $e->getMessage());
        //     return redirect()->back()
        //         ->with('error', 'Error al crear la marca en la base de datos.')
        //         ->withInput();
                
        // } catch (\Exception $e) {
        //     Log::error('Error inesperado al crear la marca: ' . $e->getMessage());
        //     return redirect()->back()
        //         ->with('error', 'Error inesperado al crear la marca.')
        //         ->withInput();
        // }