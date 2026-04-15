<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituciones = Institucion::with('posts')->get();
        // compact Convierte una variable en un array asociativo
        return view('instituciones.index', compact('instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('instituciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
        ]);
       // 🔥 importante: asociar usuario
        //$validated['user_id'] = auth()->id();
        Institucion::create($validated);
        return redirect('/instituciones')->with('success', 'Post creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institucion $institucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institucion $institucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institucion $institucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institucion $institucion)
    {
        //
    }
}
