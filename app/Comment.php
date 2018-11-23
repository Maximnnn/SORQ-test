<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['comment', 'task_id', 'user_id'];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * To store Comment
     *
     * @param $comment string
     * @param $task Task
     * @param $user User
     * @return Comment
     */
    public function store($comment, Task $task, User $user) {
        return self::create([
            'comment' => $comment,
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);
    }


    /**
     * return Comment filtered by task
     *
     * @param $task Task
     * @return Comment
     */
    public function getCommentsByTask(Task $task) {
        return Comment::where('task_id', $task->id)->get();
    }


}
