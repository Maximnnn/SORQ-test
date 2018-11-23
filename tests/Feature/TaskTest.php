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
            ->post('/tasks',[
                'title' => rand(1,10000),
                'description' => rand(1,10000)
            ]);

        $response->assertStatus(201); //todo why returns 302
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
