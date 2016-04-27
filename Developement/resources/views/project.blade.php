@extends('layouts.app')

@section('projects')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Vos projets</div>

                    <div class="panel-body">
                        Vous êtes loggé ! Voilà vos projets !
                    </div>


                    @foreach($projects as $project)
                        <div>
                        <h3><a href="{{route('project.index')}}/{{ $project->id }}">{{ $project->name }}</a></h3>
                        @foreach($project->users as $user)
                           <p>Utilisateurs :  {{ $user->lastname }} {{ $user->firstname }}</p>
                        @endforeach
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
