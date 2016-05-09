<?php

namespace App\Http\Controllers;

use App\Models\DurationsTask;
use App\Models\UsersTask;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use DateTime;


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

    function create(Task $task, Request $request)
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

        //$updateTask = Task::find($task->id);

        $task->update([
            'name' => $request->input('name'),
            'duration' => $request->input('duration'),
            'date_jalon' => $request->input('date_jalon'),
            'parent_id' => $request->input('parent_id'),
            'statut' => $request->input('statut'),
        ]);

        return redirect("project/" . $task->project_id);

    }

    public function play(Request $request)
    {
        $durationTask = new DurationsTask;
        $durationTask->user_task_id = $request->task;
        //dd($durationTask->Active($request->user));

        return $durationTask->Active($request->user, Auth::user()->id);

        /*if($durationTask->Active($request->user) == true){
            echo "déja actif";
            echo "Travail sur la tâche lancé -> =D ";
        }else{
            $durationTask->save();
        }*/


    }

    public function stop(DurationsTask $durationsTask)
    {


        $now = new DateTime();
        $durationsTask->update([
            'ended_at' => $now,
        ]);


    }

}
