@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Votre projet</div>
            <div class="panel-body">
                <!-- Include the plugin for the planning -->
                {{--@include('planning.show', ['taskparent' => $project->tasksParent])--}}
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
        
        <h1>Evénements majeur</h1>
        <div class="panel panel-default" id="events"></div>
        <a class="btn btn-warning events" data-id="{{$project->id}}">Créer un événement</a>

        <h1>Fichiers</h1>
        <div class="panel panel-default" id="files">
            <div class="container">
                <form enctype="multipart/form-data" action="{{route('files.store', $project->id)}}" method="post">
                    {!! csrf_field() !!}

                    Ajouter des fichiers<br>

                    <label class="col-md-4 control-label">Description du fichier</label>

                    <div class="col-md-6">
                        <input type="texte" class="form-control" name="description" value="" required>
                    </div>

                    <label class="col-md-4 control-label">Le fichier</label>

                    <div class="col-md-6">
                        <input type="file" name="file">
                    </div>

                    <div class="col-md-6">
                        <input type="submit" value="Envoyer">
                    </div>

                </form>
            </div>
        </div>

        <div class="panel panel-default" id="files">
            <div class="container">
                <p>Fichiers du projet</p>
                @foreach($project->files as $file)
                    <div class="file">
                        <a href="{{asset('files/'.$project->id.'/'.$file->url)}}" download="{{$file->name}}">
                            <img class="" src="{{asset('images/icon/'.$file->mime.'.png')}}">
                            <p>{{$file->name}}</p>
                            <p>{{$file->description}}</p>
                            <p>{{round($file->size / (1024*1024), 2)}} MB</p>
                        </a>
                        <button class="right btn filedestroy"  data-project="{{$project->id}}" data-id="{{$file->id}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    callEvents({{$project->id}});


@endsection





