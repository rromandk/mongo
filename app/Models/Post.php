<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{


    use SoftDeletes;
    protected $fillable = ['title', 'content','user_id','institucion_id'];


    protected static function booted(){
        static::created(function () {
            \Log::info('MODEL EVENT FUNCIONA');
    });
}

     // Relación con el usuario (autor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELACIÓN: Un post pertenece a una institución
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    /**
     * Método de ayuda para verificar si tiene institución
     */
    public function tieneInstitucion(): bool
    {
        return !is_null($this->institucion_id);
    }

    public function files()
    {
        return $this->hasMany(PostFile::class);
    }

}
