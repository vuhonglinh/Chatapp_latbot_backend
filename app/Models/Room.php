<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $table = 'rooms';

    protected $fillable = [
        'name',
        'slug',
        'customer_id',
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
}
