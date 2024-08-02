<?php

namespace Database\Factories;

use App\Enums\AccessType;
use App\Enums\ChatType;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => $this->faker->unique()->numberBetween(1, 1000000),
            'user_id' => Uuid::uuid4()->toString(),
            'language_id' => Uuid::uuid4()->toString(),
            'username' => $this->faker->unique()->userName,
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'access_type' => $this->faker->randomElement(AccessType::values()),
            'type' => $this->faker->randomElement(ChatType::values()),
            'avatar' => $this->faker->optional()->imageUrl(),
            'is_published' => $this->faker->boolean,
            'invite_link' => $this->faker->optional()->url,
            'avg_views' => $this->faker->optional()->numberBetween(0, 10000),
            'subscribers' => $this->faker->optional()->numberBetween(0, 1000000),
            'meta_title' => $this->faker->unique()->sentence(3),
            'meta_description' => $this->faker->text(278),
            'image' => $this->faker->optional()->imageUrl(),
            'image_alt' => $this->faker->optional()->sentence(5),
        ];
    }
}
