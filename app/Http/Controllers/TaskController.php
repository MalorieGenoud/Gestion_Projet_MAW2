<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


use App\Http\Requests;

class TaskController extends Controller
{
    function show(Task $task)
    {

        return view('task.show', ['task' => $task]);

    }

    function createChildren(Task $task)
    {
        return view('task.createChildren', ['task' => $task]);

    }

    function create(Task $task,Request $request)
    {
        dd($request);
        return view('task.create', ['task' => $task]);

    }

    function storeChildren(Task $task, Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->input('name');
        $newTask->duration = $request->input('duration');
        $newTask->date_jalon = $request->input('date_jalon');
        $newTask->project_id = $request->input('project_id');
        $newTask->parent_id = $request->input('parent_id');
        $newTask->save();

        return redirect("project/" . $task->project_id);
    }

    function destroy(Task $task)
    {

        $task->delete();
        return ("destroy" . $task);
    }

    function edit(Task $task, Request $request)
    {
        return view('task.edit', ['task' => $task]);
    }

    function store(Task $task, Request $request)
    {

        $updateTask = Task::find($task->id);

        $updateTask->update([
            'name' => $request->input('name'),
            'duration' => $request->input('duration'),
            'date_jalon' => $request->input('date_jalon'),
            'parent_id' => $request->input('parent_id'),
            'statut' => $request->input('statut'),
        ]);

        return redirect("project/" . $task->project_id);

    }

}
