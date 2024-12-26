<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $table = 'rooms';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'ids',
        'creator_id',
    ];

    protected $casts = [
        'ids' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
