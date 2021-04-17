<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create();
            },
            'channel_id' => function () {
                return Channel::factory()->create();
            },
            'title' => $this->faker->word(),

            'body' => $this->faker->sentence(),
        ];
    }
}
