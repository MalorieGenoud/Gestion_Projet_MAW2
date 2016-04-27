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
                @yield('planning')
            </div>

            <div class="col-md-10 col-md-offset-1">
                @yield('tasks')
            </div>

            <div class="col-md-6 col-md-offset-1">
                @yield('infos')
            </div>

            <div class="col-md-6 col-md-offset-1">
                @yield('files')
            </div>
        </div>
    </div>
@endsection
