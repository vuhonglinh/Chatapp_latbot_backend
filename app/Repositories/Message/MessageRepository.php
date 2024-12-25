<?php
//Lưu ý note tất cả lại để cho mn biết :v
namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepository;

class MessageRepository extends BaseRepository
{
    /**
     * Thiết lập Model tương tác
     *
     * @return string
     */
    public function model()
    {
        return Message::class;
    }

    /**
     * Lấy danh sách phân trang
     *
     * @param int $limit
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateMessages($limit = 25, array $columns = ['*'])
    {
        return $this->paginate($limit, $columns);
    }

    /**
     * Thêm mới
     *
     * @param array $data
     * @return \App\Models\Message
     */
    public function createMessage(array $data)
    {
        return $this->create($data);
    }

    /**
     * Cập nhật
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Message
     */
    public function updateMessageById($id, array $data)
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
    public function deleteMessageById($id)
    {
        return $this->deleteById($id);
    }

    /**
     * Lấy tất cả
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Message[]
     */
    public function getAllMessages(array $columns = ['*'])
    {
        return $this->all($columns);
    }

    /**
     * Lấy chi tiết
     *
     * @param int $id
     * @param array $columns
     * @return \App\Models\Message
     */
    public function getMessageById($id, array $columns = ['*'])
    {
        return $this->getById($id, $columns);
    }
}
