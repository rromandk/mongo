<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Comments extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';

    protected $fillable = [
        'name',
        'movie_id',
        'email',
        'text'
    ];

    public function pelicula()
    {
        return $this->belongsTo(Peliculas::class);
    }
}
