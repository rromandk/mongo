<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OllamaService;
use App\Services\SqlSecurityService;
use Illuminate\Support\Facades\DB;

class OllamaController extends Controller
{
    protected $ollama;
    protected $security;

    public function __construct(OllamaService $ollama, SqlSecurityService $security)
    {
        $this->ollama = $ollama;
        $this->security = $security;
    }

    public function index()
    {
        return view('ollama.prompt');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:500',
        ]);

        $response = $this->ollama->generate($request->prompt);

        return view('ollama.prompt', [
                    'prompt' => $request->prompt,
                    'response' => $response,
                ]);
        try {            
            // 1. Generar SQL
            $sql = $this->ollama->generateSQL($request->prompt);

            // 2. Limpiar
            $sql = $this->security->clean($sql);

            // 3. Validar
            $this->security->validate($sql);

            // 4. Ejecutar
            $results = DB::select($sql);
            DB::select($results);
            return view('ollama.prompt', [
                'prompt' => $request->prompt,
                'sql' => $sql,
                'response' => $results
            ]);

        } catch (\Throwable $e) {
            dd($e->getMessage());
            return view('ollama.prompt', [
                'error' => $e->getMessage(),
                'prompt' => $request->prompt
            ]);
        }

    }
}