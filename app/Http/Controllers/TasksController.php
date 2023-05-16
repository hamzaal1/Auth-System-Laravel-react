<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view', $user);
        $user = auth()->user();
        $tasks = $user->tasks;
        return response()->json([
            'tasks' => Tasks::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksRequest $request)
    {

        // $this->authorize('create', Tasks::class);
        $request->validated($request->all());

        $user = $request->user();
        $task = Tasks::create([
            'name' => $request->name,
            'description' => $request->description,
            'done' => $request->done,
            'user_id' => $request->user_id,
        ]);
        return response()->json(
            [
                'tasks' => $user->tasks,
                'message' => 'task add successfully',
            ], 201
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $task)
    {
        if (!auth()->user()->can('view', $task)) {
            abort(403, 'Unauthorized action.');
        } 
        return response()->json([
            'task'=>$task,
            'state'=>1
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
