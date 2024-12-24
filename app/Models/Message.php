<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $table = 'messages';

    protected $fillable = [
        'room_id',
        'sender_id',
        'message',
        'message_type',
        'status',
    ];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }


    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

}
