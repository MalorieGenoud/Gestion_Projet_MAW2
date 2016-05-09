<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">{{$task->name}} - {{$task->id}}</div>

        <div class="panel-body">
            <p>Durée initial : {{$task->duration}}</p>
            <p>Date du jalon : {{$task->date_jalon}}</p>
        </div>

        <div class="panel-heading">Rush</div>

        <div class="panel-body">
            <table class="table">
                @foreach($task->usersTasks as  $usertask)
                    <tr>
                        <th>id</th>
                        <th>created_at</th>
                        <th>ended_at</th>
                        <th>user_task_id</th>
                        <th>Durée</th>
                    </tr>

                    @foreach($usertask->durationsTasks as $duration)
                        @if($duration->ended_at)
                        <tr>
                            <td>{{$duration->id}}</td>
                            <td>{{$duration->created_at}}</td>
                            <td>{{$duration->ended_at}}</td>
                            <td>{{$duration->user_task_id}}</td>
                            <td>{{round(abs(strtotime($duration->ended_at) - strtotime($duration->created_at)) / 60). " minute"}}</td>
                        </tr>
                    @endif

                    @endforeach

                @endforeach
            </table>
        </div>
    </div>
</div>