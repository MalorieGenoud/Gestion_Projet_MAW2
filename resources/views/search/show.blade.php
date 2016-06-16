@extends('layouts.app')

@section('content')
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">Votre recherche de commentaires</div>
            <div class="panel-body">
                <table class="table">

                    @if(!$comment->isEmpty())
                        <tr>
                            <th>commentaire</th>
                            <th>crée le</th>
                            <th>id user</th>
                        </tr>
                        @foreach($comment as $comment)
                            <tr>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at}}</td>
                                <td>{{$comment->user_id}}</td>
                            </tr>
                        @endforeach
                    @else
                        <h1>Aucun résultat</h1>
                    @endif
                </table>
            </div>

            <div class="panel-heading">Votre recherche de tâches</div>
            <div class="panel-body">
                <table class="table">

                    @if(!$task->isEmpty())
                        <tr>
                            <th>id</th>
                            <th>tâche</th>
                            <th>crée le</th>
                            <th>mis à jour le</th>
                            <th>terminée le</th>
                            <th>date jalon</th>
                            <th>user_task_id</th>
                            <th>durée</th>
                        </tr>

                        @foreach($task as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>{{$task->updated_at}}</td>
                                <td>{{$task->ended_at}}</td>
                                <td>{{$task->date_jalon}}</td>
                                <td>{{$task->user_task_id}}</td>
                                <td>{{$task->duration}}</td>
                            </tr>
                        @endforeach
                    @else
                        <h1>Aucun résultat</h1>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection



