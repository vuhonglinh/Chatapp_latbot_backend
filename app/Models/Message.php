<?php

namespace App\Models;

use App\Events\MessageSent;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $table = 'messages';

    protected $fillable = [
        'room_id',
        'sender_id',
        'message',
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

    protected static function boot()
    {
        parent::boot();
        self::saved(function ($message) {
            broadcast(new MessageSent($message->room, $message))->toOthers();
        });
    }

}
