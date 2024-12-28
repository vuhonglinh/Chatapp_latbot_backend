<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        $name =  $this->faker->unique()->name;
        return [
            'name' => $name, // Tên khách hàng
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQO1smu9GUzmilB9s9MGO7DCs59Dj2pExxaUA&s', // Ảnh đại diện mặc định
            'email' => $this->faker->unique()->safeEmail, // Địa chỉ email
            'slug' => create_slug($name),
            'email_verified_at' => $this->faker->dateTimeBetween('-1 years', 'now'), // Thời gian xác minh email
            'password' => Hash::make(123456789),
            'phone_number' => '0' . $this->faker->numerify('#########'), // Số điện thoại
            'status' => 'active'
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
