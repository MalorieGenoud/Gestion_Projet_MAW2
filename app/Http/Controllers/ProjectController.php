<?php

namespace App\Http\Controllers;

use App\Models\ProjectsUser;
use Illuminate\Http\Request;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Form;


class ProjectController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('ProjectControl', ['except' => [
            'index', 'create', 'store'
        ]]);
    }


    public function index()
    { // tout les projets

        // var_dump(Project::find(1));
        //$usertest = Project::where();
        //echo $usertest->users->first()->firstname;

        //Auth::user()->projectsUsers;

        if (Auth::user()) {

            $projects = Auth::user()->projects()->get();

            return view('project', ['projects' => $projects]);

            /*
            //dd(Project::all()[0]);
            foreach($projects as $project){

                /*$totuser = count(Project::find($project->id)->users);
                $totuser = $totuser -1;*/

            //$projetnom[$project->id] = Project::find($project->id)->name;

            //$data[] = [Project::find($project->id), Project::find($project->id)->users];

            /*for($i = 0; $i <= $totuser ; $i++ ){
                echo Project::find($project->id)->users[$i]->firstname." ";
                echo Project::find($project->id)->users[$i]->lastname." ";
                $utilisateur[] = Project::find($project->id)->users[$i]->firstname;
                echo "<br>";
            }*/

        }
    }


    public function show(Request $request)
    {

        $project = Project::find($request->id);
        $userTasks = UsersTask::where("user_id", "=", Auth::user()->id)->get();
        $duration = null;
        $task = null;
        foreach ($userTasks as $userstask) {
            foreach ($userstask->durationsTasks()->get() as $durationtask) {
                if ($durationtask->ended_at == null) {
                    $duration = $durationtask->id;
                    $task = $userstask->task_id;
                }
            }
        }
        return view('project/show', ['project' => $project, 'request' => $request, 'duration' => $duration, 'taskactive' => $task]);
        //dd($project->tasks[0]->allChildren()->get());
        /*foreach($tasks as $child => $parent) {
            echo $child;
            echo $parent;
        }*/
        //dd($project->tasks[1]->parent);
        /*
        function buildtree($tasks)
        {
            $tree = array();
            echo "<ul>";
            foreach ($tasks as $task) {
                echo "<li>" . $task->id . "</li>";
                $tree[] = [
                    'parent' => $task,
                    'children' => buildtree($task->children)
                ];
            }
            echo "</ul>";
            return $tree;
        }
        $tasksTree = buildtree($project->tasksParent);
        */
    }

    public function files()
    {
        return view('project/show');
    }

    public function edit()
    {
        return view('project/edit');
    }

    public function task()
    {
        return view('project/task');
    }

    public function create()
    {
        return view('project/edition/create');
    }

    public function store(Request $request)
    {
        //dd($request->input('date'),$request->input('name'),$request->input('description'));
        //$newproject = Project::create($request->input('date'),$request->input('name'),$request->input('description'));

        $newProject = new Project;
        $relation = new ProjectsUser;
        $newProject->name = $request->input('name');
        $newProject->description = $request->input('description');
        $newProject->startdate = $request->input('date');
        $newProject->save();

        $relation->project_id = $newProject->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();

        return redirect()->route('project.index');

        //return view('project/edition/create');
    }

    public function destroy(Request $request, $id)
    {

    }

    public function createTask($id)
    {
        return view('task.create', ['project' => $id]);
    }

    public function storeTask(Request $request)
    {

        $newTask = new Task;
        $newTask->name = $request->input('name');
        $newTask->duration = $request->input('duration');
        $newTask->date_jalon = $request->input('date_jalon');
        $newTask->project_id = $request->input('project_id');
        $newTask->parent_id = NULL;
        $newTask->save();

        return redirect("project/" . $request->input('project_id'));

    }

    public function destroyUser(Request $request)
    {
        $destroyUser = ProjectsUser::where("project_id", "=", $request->id)->where("user_id", "=", $request->user)->get();
        $destroyUser->delete();
    }

    /*public function getTask(Request $request){

        if($request->ajax())
        {
            return 'getRequest has loaded comple';
        }

        $task = Task::find($request['task']);
        return view('project/taskdetail', ['task' => $task]);

        if(Request::ajax()){
            return Response::json(Request::all());
        }
    }*/

}