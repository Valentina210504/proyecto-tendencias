<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    /**public function cambioestadomarca(Request $request)
    {
        // $marca = Marca::find($request->id);
        // $marca->estado = $request->estado;
        // $marca->save(); 
        
        // primera forma
        
        /**$marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->pais_origen = $request->pais_origen;
        $marca->estado = 1;
        $marca->registradopor = $request->registradopor;
        $marca->save();
        

        // segunda forma
        $marca = Marca::create($request ->all());
        return redirect()->route('marcas.index')->with('successMsg', 'Estado de la marca cambiado exitosamente.'   );
    }**/

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
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}