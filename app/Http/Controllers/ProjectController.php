<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
//use App\Http\Requests;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('ProjectControl', ['except' => [
            'index',
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


    public function show($request)
    {
        //$tasks = Task::project();
        $project = Project::find($request);
        return view('project/show', ['project' => $project]);
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


}
