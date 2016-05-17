<li>
    <a href="#" ><span class="taskshow" data-id="{{$task->id}}"><p>{{$task->id}} - {{$task->name}}</p></span>
        <button class="right btn taskuser" data-id="{{$task->id}}"> <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span> </button>
        <button class="right btn taskdestroy"  data-id="{{$task->id}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
        <button class="right btn taskedit" data-id="{{$task->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </button>
        <button class="right btn taskplus" data-id="{{$task->id}}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
    </a>


    <!---->

    @if($task->children->isEmpty())

    @else
        <ul>
            @each('project.task', $task->children, 'task')
        </ul>
    @endif

</li>



