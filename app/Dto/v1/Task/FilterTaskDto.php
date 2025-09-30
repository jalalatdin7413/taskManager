<?php

namespace App\Dto\v1\Task;

use App\Http\Requests\v1\Task\FilterTaskRequest;

readonly class FilterTaskDto
{
    public function __construct(
        public ?string $deadline,
        public ?string $search,
        public ?string $status,
    ) {
    }

    public static function from(FilterTaskRequest $request): self
    {
        return new self(
            deadline: $request->deadline,
            search: $request->search,
            status: $request->status,
        );
    }
}