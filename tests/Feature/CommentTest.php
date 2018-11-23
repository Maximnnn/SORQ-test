<?php

namespace Tests\Feature;

use App\Comment;
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
    public function testRouteStore()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/tasks/1/comments', [
                'comment' => str_random(100)
            ])
            ->assertStatus(201)
            ->asserJson([
                'success' => 'Comment added'
            ]);
    }

    public function testStore() {

        $user = factory(User::class)->create();

        $task = Task::create([
            'title' => 'title',
            'description' => 'description'
        ]);

        $comment = (new Comment())->store('test comment', $task, $user);

        $this->assertEquals($comment->user_id, $user->id);
        $this->assertEquals($comment->comment, 'test comment');
        $this->assertEquals($comment->task_id, $task->id);

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
                'comment' => str_random(100),
            ]);

        $response->assertStatus(403);       //todo why returns 302

        $response = $this
            ->get('/tasks/' . 1 . '/comments');

        $response->assertStatus(403);      //todo why returns 302
    }
}
