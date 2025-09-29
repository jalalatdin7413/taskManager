<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'status' => TaskStatusEnum::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
