<?php

namespace App\Http\Controllers;

use App\Models\DurationsTask;
use App\Models\UsersTask;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Models\User;



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

        (new EventController())->store($request->input('project_id'), "Supprimer une tâche");

        return ("destroy" . $task);
    }

    function edit(Task $task, Request $request)
    {
        return view('task.edit', ['task' => $task]);
    }

    function store(Task $task, Request $request)
    {
        //dd($request->input('duration')*60*60);
        //$updateTask = Task::find($task->id);
        $task->update([
            'name' => $request->input('name'),
            'duration' => $request->input('duration'),
            'date_jalon' => $request->input('date_jalon'),
            'parent_id' => $request->input('parent_id') == '' ? null : $request->input('parent_id'),
            'statut' => $request->input('statut'),
        ]);

        //(new EventController())->store($request->input('project_id'), "Créer une tâche enfant");

        return redirect("project/" . $task->project_id);

    }

    public function play(Request $request)
    {
        $durationTask = new DurationsTask;
        $durationTask->user_task_id = $request->task;
        //dd($durationTask->Active($request->user));

        $user = Auth::user();
        if (!$user->getActiveTask()->isEmpty()) {
            return "";
        }

        $durationTask->save();
        return $durationTask->id;
    }

    public function stop(DurationsTask $durationsTask)
    {
        $now = new DateTime();
        $durationsTask->update([
            'ended_at' => $now,
        ]);
    }

    public function users(Task $task, Request $request){

        $usersTasks = $task->usersTasks;
        $refuse = [];
        foreach($task->project->users as $user){
            foreach($task->usersTasks as $usertask){
                if($usertask->user_id == $user->id){
                    $refuse[] = $usertask->user_id;
                }else{
                }
            }
        }

        return view('task.users', ['task' => $task,'userstask' => $usersTasks, 'project' => $task->project, 'refuse' => $refuse]);
    }

    public function storeusers(Task $task, Request $request){

        //$newUserTask = new UsersTask();

        //dd($request->input('user'));
        foreach($request->input('user') as $key => $value){
            $newUserTask = new UsersTask();
            $newUserTask->task_id = $request->task->id;
            $newUserTask->user_id = $key;
            $newUserTask->save();
        }

        return redirect("project/" . $task->project_id);

    }

    public function usertaskdelete(UsersTask $usersTask, Request $request){
        $usersTask->delete();
    }

    public function statut(Task $task, Request $request){

        if(!$task->ifChildTaskNoValidate()){
            dd("Peut pas etre validée");
        }else{
            dd("tache peut etre valide");

        }

    }



}
