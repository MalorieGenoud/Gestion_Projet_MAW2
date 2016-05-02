@extends('layouts.app')

@include('project.planning')
@include('project.task')
@include('project.info')
@include('project.file')








{{dd($project->tasks)}}





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
                @yield('project.task')
            </div>

            <div class="col-md-6 col-md-offset-1">
                @yield('project.info')
            </div>

            <div class="col-md-6 col-md-offset-1">
                @yield('project.file')
            </div>
        </div>
    </div>
@endsection
