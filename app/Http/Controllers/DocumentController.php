<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;  // 

class DocumentController extends Controller
{

       // ✅ Agregar middleware en el constructor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
    
    // Verificar si el documento tiene user_id
    if (!$document->user_id) {
        abort(403, 'El documento no tiene un usuario asignado');
    }
    
    // Verificar que el usuario autenticado es el dueño
    if (auth()->id() !== $document->user_id) {
        abort(403, 'No autorizado para descargar este documento');
    }

        // seguridad: solo dueño
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return Storage::disk('local')->download($document->ruta);
    }
}
