<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $task Task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task){
        return response()->json([
            'comments' => Comment::where('task_id', $task->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $task Task
     * @param $request StoreCommentRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, StoreCommentRequest $request) {
        Comment::create([
            'comment' => $request->validated()['comment'],
            'task_id' => $task->id,
            'user_id' => $request->user()->id
        ]);
        return redirect()
            ->back(201)
            ->with('success', 'Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
