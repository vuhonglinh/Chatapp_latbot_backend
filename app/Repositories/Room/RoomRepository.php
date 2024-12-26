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

    public function getRoomGroups($request)
    {
        try {
            $user = $request->user();
            $rooms = $this->model->whereJsonContains('ids', $user->id)->get();
            return $rooms;
        } catch (\Throwable $e) {

        }
    }

    public function createRoomGroup($request)
    {
        try {
            $user = $request->user();
            $room = $this->create([
                'name' => $request->name,
                'type' => 'group',
                'ids' => $request->ids,
                'creator_id' => $user->id,
            ]);
            return $room;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function addToGroup($request, $room_id)
    {
        try {
            $room = $this->where('id', $room_id)->first();
            $room->update([
                'name' => $request->name,
                'ids' => array_merge(array_map('intval', $request->ids), [auth()->user()->id]),
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function getMessages($request, $room_id)
    {
        try {
            $room = $this->where('id', $room_id)->first();
            $messages = $room->messages;
            return $messages;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function sendMessage($request, $room_id)
    {
        try {
            $user = $request->user();
            $room = $this->where('id', $room_id)->first();
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
