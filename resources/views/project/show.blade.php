@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Votre projet</div>

                    <div class="panel-body">
                        Apercevez votre projet ici
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <h1>Informations du projet</h1>
                @include('project.info', ['project' => $project])
            </div>

            <div class="col-md-6 col-md-offset-1">
                <h1>Vos tâches</h1>
                <ul>
                    @each('project.mytask', $project->tasksParent, 'task')
                </ul>
            </div>

            <div class="col-md-6 col-md-offset-1">

                <h1>Les tâches du projet</h1>
                <div class="tree-menu demo" id="tree-menu">
                    <ul>
                        @each('project.task', $project->tasksParent, 'task')
                    </ul>
                </div>
                <a class="btn btn-warning taskroot" data-id="{{$project->id}}">Créer une tâche racine</a>
            </div>

            <div class="col-md-6 col-md-offset-1">
                <h1>Détail de la tâche</h1>
                <div id="taskdetail"></div>
            </div>


        </div>
    </div>
@endsection





