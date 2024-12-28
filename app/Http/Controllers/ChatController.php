<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Http\Resources\RoomResource;
use App\Http\Resources\UserResource;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    private $roomRepository, $messageRepository, $userRepository;

    public function __construct(RoomRepository $roomRepository, MessageRepository $messageRepository, UserRepository $userRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function getUsers(Request $request)
    {
        try {
            $users = $this->userRepository->getUsers($request);
            return response()->json([
                'message' => 'Get users successfully',
                'data' => UserResource::collection($users)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getGroups(Request $request)
    {
        try {
            $rooms = $this->roomRepository->getRoomGroups($request);
            return response()->json([
                'message' => 'Get rooms successfully',
                'data' => RoomResource::collection($rooms)
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function createGroup(Request $request)
    {
        try {
            $room = $this->roomRepository->createRoomGroup($request);
            return response()->json([
                'message' => 'Created group successfully',
                'data' => new RoomResource($room)
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function addUserToGroup(Request $request, $room_id)
    {
        try {
            $this->roomRepository->addToGroup($request, $room_id);
            return response()->json([
                'message' => 'Add user to group successfully',
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
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
