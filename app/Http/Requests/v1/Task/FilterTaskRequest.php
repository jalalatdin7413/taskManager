<?php

namespace App\Http\Requests\v1\Task;

use Illuminate\Foundation\Http\FormRequest;

class FilterTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'   => 'nullable|in:new,in_progress,done',
            'search'   => 'nullable|string|max:255',
            'deadline' => 'nullable|date_format:Y-m-d',
        ];
    }
}