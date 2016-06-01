<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ProjectsUser;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\Event;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function eventsProject(Project $project, Request $request)
    {
        // dd($project->events);
        //dd(Project::find($request->id)->events);

        $events = Project::find($request->id)->events;

        return $events->toJson();
    }

    public function store($project, $desc)
    {
        $event = new Event;
        $event->user_id = Auth::user()->id;
        $event->project_id = $project;
        $event->description = $desc;
        $event->save();

    }

}
