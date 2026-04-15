<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    
    // Especificar el nombre correcto de la tabla
    protected $table = 'instituciones';

    
    // Especificar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'sitio_web',
        'descripcion'
    ];

     /**
     * RELACIÓN: Una institución tiene muchos posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Método de ayuda para obtener el nombre formateado
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' (' . $this->email . ')';
    }
}
