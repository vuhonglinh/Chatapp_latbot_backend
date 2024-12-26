<?php
//Lưu ý note tất cả lại để cho mn biết :v
namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{
    public function model()
    {
        return Room::class;
    }

    public function paginateRooms($limit = 25, array $columns = ['*'])
    {
        return $this->paginate($limit, $columns);
    }

    public function createRoom(array $data)
    {
        return $this->create($data);
    }


    public function updateRoomById($id, array $data)
    {
        return $this->updateById($id, $data);
    }

    public function deleteRoomById($id)
    {
        return $this->deleteById($id);
    }


    public function getAllRooms(array $columns = ['*'])
    {
        return $this->all($columns);
    }


    public function getRoomById($id, array $columns = ['*'])
    {
        return $this->getById($id, $columns);
    }

    public function sendMessage($request, $room_id)
    {
        try{
//            $message = $this->model->cea
        }catch (\Throwable $e){
            throw $e;
        }
    }
}
