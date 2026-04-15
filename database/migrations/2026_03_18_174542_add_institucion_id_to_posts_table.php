<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
             $table->foreignId('institucion_id')
                  ->nullable() // Permite posts sin institución
                  ->after('user_id')
                  ->constrained('instituciones') // Crea la FK hacia instituciones
                  ->onDelete('set null'); // Si borran la institución, el campo queda null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
             // Eliminar la relación primero
            $table->dropForeign(['institucion_id']);
            // Luego eliminar el campo
            $table->dropColumn('institucion_id');
        });
    }
};
