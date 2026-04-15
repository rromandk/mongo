<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// en Laravel 11/12 el método authorize() NO viene automáticamente disponible como antes.
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Institucion;
use App\Models\PostFile;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;


    public function __construct(){
      //  $this->authorizeResource(Post::class, 'post');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create', Post::class);    
        $instituciones = Institucion::all(); // Obtener todas las instituciones
        return view('posts.create', compact('instituciones'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 /*       dd([
        'auth_check' => auth()->check(),
        'user_id' => auth()->id(),
        'user' => auth()->user()
    ]);
   */     // 🔍 DEPURACIÓN: Ver qué datos llegan
        //dd($request->all());

         $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'institucion_id' => 'nullable|exists:instituciones,id',
            'files.*' => 'file|max:10240' // 10MB
        ]);
       // 🔥 importante: asociar usuario
        $validated['user_id'] = auth()->id();        
        $post = Post::create($validated);

         // 🔥 guardar archivos en S3
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = Storage::disk('s3')->put('posts', $file);

                PostFile::create([
                    'post_id' => $post->id,
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                ]);
            }
        }


        return redirect('/posts')->with('success', 'Post creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
       // Verifica si puede actualizar
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
         $post->update($request->all());
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts')->with('success', 'Post eliminado');
    }
}
