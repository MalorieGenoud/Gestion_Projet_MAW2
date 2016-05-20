<table class="table">
    <tr>
        <th>id</th>
        <th>user_id</th>
        <th>Action</th>
    </tr>
    @foreach($userstask as $usertask)
        <tr>
            <td>{{$usertask->id}}</td>
            <td>{{$usertask->user_id}}</td>
            <td>
                <button class="right btn usertaskdestroy" data-id="{{$usertask->id}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            </td>
        </tr>
    @endforeach
</table>


<form class="form-horizontal" role="form" method="POST" action="{{Route('tasks.storeusers',$task->id)}}">
    {!! csrf_field() !!}
    <div class="checkbox">
        @foreach($project->users as $user)

            @if(!in_array($user->id,$refuse))
                <label>
                    <input type="checkbox" name="user[{{$user->id}}]">
                    {{ $user->lastname }} {{ $user->firstname }}
                </label>
            @endif

        @endforeach
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Ajouter un utilisateur
            </button>
        </div>
    </div>
</form>