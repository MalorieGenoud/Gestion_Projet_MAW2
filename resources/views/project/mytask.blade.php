@foreach ($task->usersTasks as $usertask)

    @if($usertask->user_id == Auth::user()->id)

        {{--@if($task->id == '30')--}}
        {{--{{$task->id}}--}}
        {{--@endif--}}

        <li>
            <a>
                <span class="taskshow" data-id="{{$task->id}}">
                    <p>{{$task->id}} - {{$task->name}}</p>
                </span>
                <button class="right btn btn-lg
                @if($taskactive == null)
                        taskplay" data-usertaskid="{{$usertask->id}}"
                        @elseif($taskactive == $task->id)
                        taskstop
                " data-usertaskid="{{$usertask->id}}" data-duration="{{$duration}}"
                @else
                    taskplay" data-usertaskid="{{$usertask->id}}"
                @endif
                >
                <span class="glyphicon
                @if($taskactive == null)
                        glyphicon-play-circle
                      @elseif($taskactive == $task->id)
                        glyphicon-stop
                  @else()
                        glyphicon-play-circle
                      @endif
                        " aria-hidden="true"></span>
                </button>
            </a>
    @else
        <li>
    @endif


            @if($task->children->isEmpty())

            @else
                <ul>
                    @foreach($task->children as $task)
                        @include('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration])
                    @endforeach
                </ul>
            @endif
    </li>


        @endforeach