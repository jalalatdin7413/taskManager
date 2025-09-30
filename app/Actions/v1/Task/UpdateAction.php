<?php

namespace App\Actions\v1\Task;

use App\Dto\v1\Task\UpdateDto;
use App\Enums\TaskStatusEnum;
use App\Exceptions\ApiResponseException;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class UpdateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @param \App\Dto\v1\Task\UpdateDto $dto
     * @return JsonResponse
     * @throws \App\Exceptions\ApiResponseException
     */
    public function __invoke(int $id, UpdateDto $dto): JsonResponse
    {
        try {
            $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

            if (in_array($task->status, [TaskStatusEnum::DONE->value])) {
                throw new ApiResponseException("Task orinlanip boldi o'zgermeydi", 403);
            }

            $task->update(array_filter([
                'title'       => $dto->title,
                'description' => $dto->description,
                'deadline'    => $dto->deadline,
                'status'      => $dto->status,
            ]));

            return static::toResponse(
                message: "$id - id li task jan'alandı",
                data: new TaskResource($task)
            );
        } catch (ModelNotFoundException) {
            throw new ApiResponseException('Task tabilmadi', 404);
        }
    }
}    