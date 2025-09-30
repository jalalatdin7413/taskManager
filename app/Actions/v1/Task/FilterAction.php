<?php

namespace App\Actions\v1\Task;

use App\Dto\v1\Task\FilterTaskDto;
use App\Http\Resources\v1\TaskCollection;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class FilterAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\v1\Task\FilterTaskDto $dto
     * @return JsonResponse
     */
    public function __invoke(FilterTaskDto $dto): JsonResponse
    {
        $query = Task::where('user_id', auth()->id());

        if ($dto->status) {
            $query->where('status', $dto->status);
        }

        if ($dto->search) {
            $query->where(function ($q) use ($dto) {
                $q->where('title', 'like', "%{$dto->search}%")
                  ->orWhere('description', 'like', "%{$dto->search}%");
            });
        }

        if ($dto->deadline) {
            $query->whereDate('deadline', $dto->deadline);
        }

        $tasks = $query
            ->orderBy('deadline')
            ->paginate(10);

        return static::toResponse(
            message: 'Filtered tasks',
            data: new TaskCollection($tasks)
        );
    }
}