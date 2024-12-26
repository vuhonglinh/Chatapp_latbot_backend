<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Room\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    private $roomRepository, $messageRepository;

    public function __construct(RoomRepository $roomRepository, MessageRepository $messageRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->messageRepository = $messageRepository;
    }

    public function getRoomMessages(Request $request, $room_id)
    {
        try {
            $messages = $this->roomRepository->getMessages($request, $room_id);
            return response()->json([
                'message' => 'Get all messages successfully',
                'data' => MessageResource::collection($messages)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function send(Request $request, $room_id)
    {
        try {
            $message = $this->roomRepository->sendMessage($request, $room_id);
            return response()->json([
                'message' => 'Send message successfully',
                'data' => new MessageResource($message)
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
