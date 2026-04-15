<?php

namespace App\Services;

class SqlSecurityService
{
    public function clean(string $sql): string
    {
        // eliminar comentarios
        $sql = preg_replace('/--.*$/m', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

        return trim($sql);
    }

    public function validate(string $sql): void
    {
        echo $sql;
        $sqlLower = strtolower(trim($sql));

        // ❌ múltiples statements
        if (str_contains($sql, ';')) {
            // 1. normalizar
            $sql = trim($sql);

            // 2. eliminar comentarios tipo --
            $sql = preg_replace('/--.*$/m', '', $sql);

            // 3. eliminar TODO al final ( ; + espacios + saltos )
            $sql = preg_replace('/[;\s]+$/', '', $sql);


            // 4. validar múltiples queries
            if (strpos($sql, ';') !== false) {
               // throw new \Exception("Múltiples queries no permitidas");
            }
        }

        // ❌ solo SELECT
        if (!str_starts_with(trim($sqlLower), 'select')) {
            //throw new \Exception("Solo se permiten SELECT");
        }

        // ❌ comandos peligrosos
        $forbidden = ['insert', 'update', 'delete', 'drop', 'truncate', 'alter'];

        foreach ($forbidden as $word) {
            if (str_contains($sqlLower, $word)) {
                throw new \Exception("SQL prohibido: $word");
            }
        }

        // ❌ tablas prohibidas
        foreach (config('ai_sql.forbidden_tables') as $table) {
            if (str_contains($sqlLower, $table)) {
                throw new \Exception("Tabla prohibida: $table");
            }
        }

        // ❌ LIMIT obligatorio
        if (!str_contains($sqlLower, 'limit')) {
            throw new \Exception("La query debe tener LIMIT");
        }
    }
}