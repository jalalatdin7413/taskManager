<?php

namespace App\Actions\v1\Task;

use App\Exceptions\ApiResponseException;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class DeleteAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exceptions\ApiResponseException
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
            $task->delete();

            return static::toResponse(
                message: "$id - id li task o'shirildi"
            );
        } catch (ModelNotFoundException $ex) {
            throw new ApiResponseException('Task tabilmadi', 404);
        }
    }
}