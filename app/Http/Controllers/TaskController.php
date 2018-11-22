<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request Request
     * @param $task Task
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Task $task)
    {
        Validator::make($request->all(), [
            'title' => 'string',
            'assignee_id' => 'int',
        ])->validate();

        $search = array_filter([
            'title' => $request->get('title'),
        ]);

        $filter = array_filter([
            'assignee_id' => $request->get('assignee_id')
        ]);

        return view('tasks', [
            'tasks' => $task->getTasksWithAllData($filter, $search)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Route turned off
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTaskRequest $request
     * @param  $task Task
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request, Task $task)
    {
        $request->validateResolved();

        $task->store($request->validated());

        return redirect()
            ->back('201')
            ->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //Route turned off
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //Route turned off
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //Route turned off
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //Route turned off
    }
}
