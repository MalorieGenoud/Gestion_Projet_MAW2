@extends('layouts.app')


@section('content')
    <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Votre projet</div>

                <div class="panel-body">
                    @include('planning.show', ['taskparent' => $project->tasksParent])
                </div>
        </div>




        <div class="row">
            <div class="col-md-6">
                <h1>Vos tâches</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        @foreach($project->tasksParent as $task)
                            @include('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration])
                        @endforeach
                    </ul>
                </div>
                <h1>Les tâches du projet</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
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
        @include('project.info', ['project' => $project])
        <h1>Evènements majeur</h1>
        <div class="panel panel-default" id="events"></div>

        <h1>Fichiers</h1>
        <div class="panel panel-default" id="files">
            <form enctype="multipart/form-data" action="{{route('files.store', $project->id)}}" method="post">
                {!! csrf_field() !!}

                Ajouter des fichiers<br>

                <label class="col-md-4 control-label">Description du fichier</label>

                <div class="col-md-6">
                    <input type="texte" class="form-control" name="description" value="" required>
                </div>

                <label class="col-md-4 control-label">Description du fichier</label>

                <div class="col-md-6">
                    <input type="file" name="file">
                </div>

                <div class="col-md-6">
                    <input type="submit" value="Envoyer">
                </div>


            </form>
        </div>


    </div>
@endsection

@section('script')
    callEvents({{$project->id}});
@endsection





