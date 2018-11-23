<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function testRouteStore()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->json('POST','/tasks',[
                'title' => str_random(20),
                'description' => str_random(100)
            ])
            ->assertStatus(201)
            ->assertJson(['success' => 'Task created']);
    }

    public function testStore() {

        $task = (new Task)->store([
            'title' => 'title',
            'description' => 'description'
        ]);

        $this->assertEquals($task->title, 'title');
        $this->assertEquals($task->description, 'description');
    }

    public function testGet()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/tasks');

        $response->assertStatus(200);
        $response->assertsee('Create Task');
        $response->assertViewHas('tasks');
    }
}
