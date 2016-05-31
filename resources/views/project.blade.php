@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach($projects as $project)

        <div class="panel panel-default">
            <div class="panel-heading"><h2><a href="{{route('project.index')}}/{{ $project->id }}">{{ $project->name }}</a></h2></div>
            <div class="panel-body">
                <h4>Membres : </h4>
                @foreach($project->users as $user)
                    <p>{{ $user->lastname }} {{ $user->firstname }}</p>
                @endforeach
            </div>
        </div>
        @endforeach
        <a class="button btn btn-default" href="{{route('project.create')}}">Créer votre projet !</a>

    </div>
@endsection
