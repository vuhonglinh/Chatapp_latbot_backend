<?php
namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{
    public function model()
    {
        return Room::class;
    }

    public function getMessages($request,$room_id){
        try{
            $room = $this->where('id',$room_id)->first();
            $messages = $room->messages;
            return $messages;
        }catch (\Throwable $e){
            throw $e;
        }
    }

    public function sendMessage($request, $room_id)
    {
        try {
            $user = $request->user();
            $room = $this->where('id',$room_id)->first();
            $message = $room->messages()->create([
                'sender_id' => $user->id,
                'message' => $request->message,
            ]);
            return $message;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
