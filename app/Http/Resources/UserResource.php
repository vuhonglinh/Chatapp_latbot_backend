<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'avatar' => $this->avatar,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'slug' => $this->slug,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
        ];
    }
}
