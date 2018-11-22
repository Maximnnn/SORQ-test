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
     * @param $comment Comment
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task, Comment $comment){
        return response()->json([
            'comments' => $comment->getCommentsByTask($task)
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
     * @param $comment Comment
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, StoreCommentRequest $request, Comment $comment) {

        $comment->store(
            $request->validated()['comment'],
            $task,
            $request->user()
        );

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
