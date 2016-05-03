
@foreach ($task->usersTasks as $usertask)

    @if ($usertask->user_id == Auth::user()->id)
        <li>{{$task->id}} || {{$task->name}}</li>
    @endif
        <ul>
            @each('project.mytask', $task->children, 'task')
        </ul>

@endforeach



