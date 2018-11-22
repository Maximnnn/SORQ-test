<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function testCreate()
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
