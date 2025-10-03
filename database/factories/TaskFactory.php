<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => TaskStatusEnum::NEW,
            'user_id' => 1,
            'deadline' => now()->addDays(3),
        ];
    }
}