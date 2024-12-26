<?php

namespace App\Http\Controllers;

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

    public function send(Request $request,$room_id){
        try{
            $message = $this->roomRepository->
            return response()->json([
                'message' => 'Send message successfully'
            ],Response::HTTP_OK);
        }catch (\Throwable $e){
            return response()->json([
                'message' => $e->getMessage()
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
