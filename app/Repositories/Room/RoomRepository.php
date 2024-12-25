<?php
//Lưu ý note tất cả lại để cho mn biết :v
namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{
    /**
     * Thiết lập Model tương tác
     *
     * @return string
     */
    public function model()
    {
        return Room::class;
    }

    /**
     * Lấy danh sách phân trang
     *
     * @param int $limit
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateRooms($limit = 25, array $columns = ['*'])
    {
        return $this->paginate($limit, $columns);
    }

    /**
     * Thêm mới
     *
     * @param array $data
     * @return \App\Models\Room
     */
    public function createRoom(array $data)
    {
        return $this->create($data);
    }

    /**
     * Cập nhật
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Room
     */
    public function updateRoomById($id, array $data)
    {
        return $this->updateById($id, $data);
    }

    /**
     * Xóa
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteRoomById($id)
    {
        return $this->deleteById($id);
    }

    /**
     * Lấy tất cả
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Room[]
     */
    public function getAllRooms(array $columns = ['*'])
    {
        return $this->all($columns);
    }

    /**
     * Lấy chi tiết
     *
     * @param int $id
     * @param array $columns
     * @return \App\Models\Room
     */
    public function getRoomById($id, array $columns = ['*'])
    {
        return $this->getById($id, $columns);
    }
}
