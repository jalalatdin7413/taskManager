<?php

namespace App\Actions\v1\Task;

use App\Dto\v1\Task\CreateDto;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Traits\ResponseTrait;

class CreateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\v1\Task\CreateDto $dto
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(CreateDto $dto)
    {
        $data = [
            'title' => $dto->title,
            'description' => $dto->description,
            'deadline' => $dto->deadline,
            'status' => TaskStatusEnum::NEW,
            'user_id' => auth()->id(),
        ];

        $task = Task::create($data);

        return static::toResponse(
            message: 'Task awmetli jaratildi',
            data: $task
        );
    }
}