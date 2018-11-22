<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->post('/tasks/1/comments',[
                'comment' => rand(1,10000),
            ]);

        $response->assertStatus(201); //todo why returns 302
    }

    public function testGet()
    {
        $user = factory(User::class)->create();

        $id = Task::min('id');

        if ($id) {
            $response = $this
                ->actingAs($user)
                ->get('/tasks/' . $id . '/comments');

            $response->assertStatus(200);
            $response->assertJson(['comments' => []]);
        }

        $id = Task::max('id') + 1;
        $response = $this
            ->actingAs($user)
            ->get('/tasks/' . $id . '/comments');

        $response->assertStatus(404);
    }

    public function testAccess() {
        $response = $this
            ->post('/tasks/1/comments',[
                'comment' => rand(1,10000),
            ]);

        $response->assertStatus(403);       //todo why returns 302

        $response = $this
            ->get('/tasks/' . 1 . '/comments');

        $response->assertStatus(403);      //todo why returns 302
    }
}
