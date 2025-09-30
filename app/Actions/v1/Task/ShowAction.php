<?php

namespace App\Actions\v1\Task;

use App\Exceptions\ApiResponseException;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ShowAction
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
            $task = Task::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $key = 'tasks:show:' . app()->getLocale() . ':' . md5(request()->fullUrl());

            $cachedTask = Cache::remember($key, now()->addDay(), function () use ($task) {
                return Task::find($task->id);
            });

            return static::toResponse(
                message: "$id - id li task",
                data: new TaskResource($cachedTask)
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException('Task Not Found', 404);
        }
    }
}
