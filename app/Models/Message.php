<?php

namespace App\Models;
use App\Models\User;
use App\Models\Document;
use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'messages';
    //$fillable solo controla qué campos se pueden asignar masivamente, no los hace obligatorios.
    protected $fillable = ['asunto','fecha','mensaje','user_id'];


    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function getUserNameAttribute()
    {
       return $this->user()?->name;
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'message_id', '_id');
    }
}