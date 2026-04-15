<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OllamaService
{
    public function generate(string $prompt): string
    {
        $response = Http::timeout(120)->post(config('services.ollama.url') . '/api/generate', [
            'model' => config('services.ollama.model'),
            'prompt' => $prompt,
            'stream' => false,
        ]);

        $response->throw();

        return $response->json('response') ?? '';
    }




    private function extractSQL($response)
    {
        // buscar bloque ```sql ... ```
        if (preg_match('/```sql(.*?)```/is', $response, $matches)) {
            return trim($matches[1]);
        }

        // fallback: devolver todo si no hay bloque
        return trim($response);
    }


      public function generateSQL(string $question): string
    {
       
        $schema = collect(config('ai_sql.allowed_tables'))
            ->map(fn($cols, $table) => "$table(" . implode(', ', $cols) . ")")
            ->implode("\n");

        $prompt = "
        Sos un experto en SQL MySQL.

        Solo podés usar estas tablas:
        $schema

        Reglas:
        - SOLO SELECT
        - NO usar INSERT, UPDATE, DELETE, DROP
        - SIEMPRE usar LIMIT " . config('ai_sql.max_limit') . "
        - NO explicar nada
        - SOLO devolver SQL válido

        Consulta:
        $question
        ";

        $response = Http::timeout(120)->post(config('services.ollama.url') . '/api/generate', [
            'model' => config('services.ollama.model'),
            'prompt' => $prompt,
            'stream' => false,
        ]);

        $data = $response->json();
        $raw = $data['response'] ?? '';

        return $this->extractSQL($raw);
    }
}