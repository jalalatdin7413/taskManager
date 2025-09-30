<?php

namespace App\Http\Requests\v1\Task;

use App\Enums\TaskStatusEnum;
use Illuminate\Validation\Rule;

class UpdateRequest extends CreateRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tittle' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'deadline' => 'sometimes|date_format:Y-m-d',
            'status' => ['sometimes', Rule::enum(TaskStatusEnum::class)],
        ];
    }
}