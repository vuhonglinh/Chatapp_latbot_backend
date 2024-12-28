<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    //Xác thực mạng xã hội
    public function loginOauth($data)
    {
        DB::beginTransaction();
        $checkCustomer = User::where('email', $data->getEmail())->first();

        if ($checkCustomer && !$checkCustomer->social_id && !$checkCustomer->social_module) {
            throw new \Exception('Tài khoản đã tồn tại');
        }

        if ($checkCustomer && @$checkCustomer->status != 'active') {
            throw new \Exception('Tài khoản đã bị khóa');
        }

        try {
            $dataCustomer = [
                "name" => $data->getName(),
                "email" => $data->getEmail(),
                "password" => 18072001,
                "username" => $data->getNickname() ?? $data->getName(),
                // "avatar" => $data->getAvatar(),
                "avatar" => env('DEFAULT_AVATAR'),
                "social_id" => $data->getId(),
                "social_module" => "google",
                "email_verified_at" => now()
            ];

            $customer = $this->model->firstOrCreate(
                [
                    "email" => $data->getEmail(),
                    "social_id" => $data->getId(),
                ],
                $dataCustomer
            );
            DB::commit();
            return $customer;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
