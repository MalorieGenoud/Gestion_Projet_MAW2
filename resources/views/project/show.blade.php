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
                <h1>Planning</h1>
                @yield('planning.as')
            </div>

            <div class="col-md-10 col-md-offset-1">
                <h1>Les tâches de tout le projet</h1>
                <ul>
                @each('project.task', $project->tasksParent, 'task')
                </ul>
            </div>

            <div class="col-md-6 col-md-offset-1">
                <h1>Vos tâches</h1>
                <ul>
                    @each('project.mytask', $project->tasksParent, 'task')
                </ul>
            </div>

            <div class="col-md-6 col-md-offset-1">
            @yield('project.file')
            </div>
        </div>
    </div>
@endsection
