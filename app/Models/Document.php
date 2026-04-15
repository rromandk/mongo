<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Document extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'documents';

    protected $fillable = [
        'message_id',
        'nombre',
        'ruta',
        'user_id'
    ];
}