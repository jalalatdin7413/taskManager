<?php

namespace Database\Seeders;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Jana proyekt islew',
            'description' => 'Laravel tiykarinda jana proyekt baslaw.',
            'status' => TaskStatusEnum::NEW->value,
            'deadline' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'user_id' => 1,
        ]);

        Task::create([
            'title' => 'Postman testlerin jaziw',
            'description' => 'Barliq API endpointlar ushin test jaziw.',
            'status' => TaskStatusEnum::IN_PROGRESS->value,
            'deadline' => Carbon::now()->addDays(10)->format('Y-m-d'),
            'user_id' => 1,
        ]);
    }
}