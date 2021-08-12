<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Notifications\DatabaseNotification;

class ThreadNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DatabaseNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>,
            'type'=>'App\Notifications\ThreadUpdated',
            'notifiable_type'=>'App\Models\User',
            'notifiable_id'=>1,
            'data'=>['foo'=>'bar']
        ];
    }
}
