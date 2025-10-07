<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class TaskController extends Controller
{
    #[OA\Get(
        path: '/api/v1/tasks',
        tags: ['Task'],
        summary: 'Get all tasks',
        description: 'Retrieves a list of all tasks',
        security: [['sanctum' => []]]
    )]
    #[OA\Response(response: 200, description: "Succesfully response")]
    #[OA\Response(response: 401, description: "Unauthorized")]
    #[OA\Response(response: 404, description: "Not Found")]
    public function index()
    {
        //
    }

    #[OA\Get(path: '/api/v1/tasks/show/{id}', tags: ['Task'], summary: 'Get a specific task', description: 'Retrieves a specific task by its ID', security: [['sanctum' => []]])]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'ID of the task to retrieve',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(response: 200, description: 'Successful response')]
    #[OA\Response(response: 401, description: 'Unauthorized')]
    #[OA\Response(response: 404, description: 'Task not found')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function show()
    {
        //
    }

    #[OA\Post(
        path: '/api/v1/tasks/create',
        tags: ['Task'],
        summary: 'Create a new task',
        description: 'Creates a new task',
        security: [['sanctum' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        description: 'Task creation payload',
        content: new OA\JsonContent(
            required: ['title', 'description', 'deadline', 'priority'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'Finish report'),
                new OA\Property(property: 'description', type: 'string', example: 'Complete the quarterly financial report'),
                new OA\Property(property: 'deadline', type: 'string', format: 'date-time', example: '2025-10-10'),
                new OA\Property(property: 'status', type: 'string', example: 'new'),
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'Task successfully created')]
    #[OA\Response(response: 401, description: 'Unauthorized')]
    #[OA\Response(response: 404, description: 'Not found')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function create()
    {
        //
    }

    #[OA\Put(path: '/api/v1/tasks/update/{id}', tags: ['Task'], summary: 'Update a specific task', description: 'Updates a specific task by its ID', security: [['sanctum' => []]])]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'ID of the task to update',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\RequestBody(
        required: true,
        description: 'Task update payload',
        content: new OA\JsonContent(
            required: ['title', 'description', 'deadline', 'priority'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'Finish report'),
                new OA\Property(property: 'description', type: 'string', example: 'Complete the quarterly financial report'),
                new OA\Property(property: 'deadline', type: 'string', format: 'date-time', example: '2025-10-10'),
                new OA\Property(property: 'status', type: 'string', example: 'in_progress'),
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'Task successfully updated')]
    #[OA\Response(response: 401, description: 'Unauthorized')]
    #[OA\Response(response: 404, description: 'Task not found')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function update()
    {
        //
    }

    #[OA\Delete(
        path: '/api/v1/tasks/delete/{id}',
        tags: ['Task'],
        summary: 'User taskdi oshiredi',
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',

                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            )
        ]
    )]
    #[OA\Response(response: 200, description: 'Task successfully deleted')]
    #[OA\Response(response: 404, description: 'Task not found')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function delete()
    {
        //
    }

    #[OA\Get(
        path: '/api/v1/tasks/filter',
        tags: ['Task'],
        summary: 'Tasklardi filterlew',
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(
                name: 'status',
                in: 'query',
                required: false,
                description: 'Task statusi (new, in_progress, done)',
                schema: new OA\Schema(type: 'string', example: 'in_progress')
            ),
            new OA\Parameter(
                name: 'search',
                in: 'query',
                required: false,
                description: 'Title yamasa description boyinsha search',
                schema: new OA\Schema(type: 'string', example: 'Barliq')
            ),
            new OA\Parameter(
                name: 'deadline',
                in: 'query',
                required: false,
                description: "Taskdin' sanesi (Y-m-d format)",
                schema: new OA\Schema(type: 'string', format: 'date', example: '2025-10-17')
            )
        ]
    )]
    #[OA\Response(response: 200, description: 'Filtered tasks')]
    #[OA\Response(response: 404, description: 'Search info not found')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function filter()
    {
        //
    }
}