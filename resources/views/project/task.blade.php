<li>{{$task->id}} || {{$task->name}}</li>
<ul>
    @each('project.task', $task->children, 'task')
</ul>

