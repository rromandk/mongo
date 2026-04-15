<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;


class MessageController extends Controller
{
    
    
    public function store(StoreMessageRequest $request)
    {
      
        $data = $request->validated();
        $data['user_id'] = auth()->id();  // ← Forzar user_id
        
        // Verificar que el usuario está autenticado
        if (!auth()->check()) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        dd($data);
        $message = Message::create($data);
        
        return response()->json($message, 201);
        // Message::create($request->validated());
    }
}
