<?php

namespace Tests\Feature;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->seed();

        $user = User::find(1);
        Sanctum::actingAs($user, ['access-token']);
    }

    public function test_task_can_get_all()
    {
        $response = $this->getJson("api/v1/tasks");

        $response->assertStatus(200);

        $this->assertIsArray($response->json('data'));

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'items' => [
                    [
                        'id',
                        'title',
                        'description',
                        'deadline',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'pagination' => [
                    'current_page',
                    'per_page',
                    'last_page',
                    'total',
                ],
            ],
        ]);
    }

    public function test_task_can_show()
    {
        $user = User::find(1);
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson('api/v1/tasks/show/' . $task->id);

        $response->assertStatus(200);

        $this->assertIsArray($response->json('data'));

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'title',
                'description',
                'deadline',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_task_can_create()
    {
        $user = User::find(1);

        $taskData = [
            'title' => 'New Task',
            'description' => 'This is a new task description.',
            'deadline' => now()->format('Y-m-d'),
            'user_id' => $user->id,
            'status' => TaskStatusEnum::NEW,
        ];

        $response = $this->postJson('api/v1/tasks/create', $taskData);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'message' => 'Task awmetli jaratildi',
            ]);
    }

    public function test_task_can_update()
    {
        $user = User::find(1);
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $updateData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated description.',
            'deadline' => now()->addDays(5)->format('Y-m-d'),
            'status' => TaskStatusEnum::IN_PROGRESS,
        ];

        $response = $this->putJson('api/v1/tasks/update/' . $task->id, $updateData);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'message' => "$task->id - id li task jan'alandı",
            ]);
    }

    public function test_task_can_delete()
    {
        $user = User::find(1);
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->deleteJson('api/v1/tasks/delete/' . $task->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'message' => "$task->id - id li task o'shirildi",
            ]);
    }

    public function test_task_can_filter()
    {
        $user = User::find(1);

        Task::factory()->count(3)->create([
            'user_id' => $user->id,
            'status' => 'new',
        ]);
        Task::factory()->count(2)->create([
            'user_id' => $user->id,
            'status' => 'done',
        ]);

        $response = $this->getJson('/api/v1/tasks/filter?status=new');

        $response->assertStatus(200);

        $this->assertIsArray($response->json('data'));

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'items' => [
                    [
                        'id',
                        'title',
                        'description',
                        'deadline',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'pagination' => [
                    'current_page',
                    'per_page',
                    'last_page',
                    'total',
                ],
            ],
        ]);
    }
}