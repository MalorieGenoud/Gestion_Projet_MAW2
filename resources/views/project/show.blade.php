@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Votre projet</div>
            <div class="panel-body">
                <!-- Include the plugin for the planning -->
                @include('planning.show', ['taskparent' => $project->tasksParent])
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h1>Vos tâches</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display the tasks connected user -->
                        @foreach($project->tasksParent as $task)
                            @include('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration])
                        @endforeach
                    </ul>
                </div>
                <h1>Les tâches du projet</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display all project tasks -->
                        @each('project.task', $project->tasksParent, 'task')
                    </ul>
                </div>
                <a class="btn btn-warning taskroot" data-id="{{$project->id}}">Créer une tâche racine</a>
            </div>
            <div class="col-md-6"><h1>Détail de la tâche</h1>
                <div id="taskdetail"></div>
            </div>
        </div>

        <h1>Informations du projet</h1>
        <!-- Display all project informations like the members, a description and so on -->
        @include('project.info', ['project' => $project])
        <h1>Evènements majeur</h1>
        <div class="panel panel-default" id="events"></div>

        <h1>Fichiers</h1>
        <div class="panel panel-default" id="files">
            <p>Fichier ici</p>
        </div>


    </div>
@endsection

@section('script')
    callEvents({{$project->id}});
@endsection





