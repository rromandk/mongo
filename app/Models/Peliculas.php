<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Comments;

class Peliculas extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'movies';


    protected $fillable = [
        'title',
        'fullplot',
        'year',
        'genres'
    ];

   public function comments()
    {
        return $this->hasMany(Comments::class, 'movie_id', '_id');
    }

}


/*
🔄 Cambio importante en v5
Antes (viejo driver)	Ahora (v5)
$collection	❌ deprecated
$table	✅ correcto

*/
