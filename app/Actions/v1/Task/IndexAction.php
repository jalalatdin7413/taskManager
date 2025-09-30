<?php

namespace App\Actions\v1\Task;

use App\Http\Resources\v1\TaskCollection;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Cache;

class IndexAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $key = 'tasks:' . auth()->id() . ':' . app()->getLocale() . ':' . md5(request()->fullUrl());
        $tasks = Cache::remember($key, now()->addDay(), function () {
            return Task::where('user_id', auth()->id())
                ->where('status', '!=', 'done')
                ->orderBy('deadline', 'asc')
                ->paginate(10);
        });

        return static::toResponse(
            message: 'Tasklar muvaffaqiyatli olindi',
            data: new TaskCollection($tasks)
        );
    }
}