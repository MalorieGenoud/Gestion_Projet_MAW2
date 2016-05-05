<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Bones</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/template.css') }}"/>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Bones
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <!-- Authentication Links -->
            @if (Auth::user())
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Tout les projets</a></li>

                    <li><a href="{{ url('/project/{id}/show') }}">Le projet</a></li>
                    <li><a href="{{ url('/project/{id}/edit') }}">Modifier le projet</a></li>

                    <li><a href="{{ url('/project/create') }}">Nouveau projet</a></li>
                </ul>

                @else

                @endif

                        <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>

                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
        </div>
    </div>
</nav>
<input type="hidden" name="_token" value="{{ csrf_token() }}">


@yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ URL::asset('js/jquery.ntm.js') }}"></script>
<script src="{{ URL::asset('js/bootbox.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).ready(function () {
        $('.demo').ntm();
    });

</script>

<script type="text/javascript">

    $(document).ready(function () {

        $('.taskshow').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task, {}, function (task) {
                console.log(task);
                $('#taskdetail').html(task);
            });

            /*$.ajax({
             type : "POST",
             url : "",
             data : task,
             success : function(task){
             console.log(task);
             $('#taskdetail').html(task);
             }
             });*/

            $.get('', function (task) {
                //console.log(task);
            });
        });

        $('button.taskedit').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task + "/edit", {}, function (task) {
                $('#taskdetail').html(task);
            });
        });

        $('button.taskplus').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task + "/children/create", {}, function (task) {
                $('#taskdetail').html(task);
            });
        });

        $('.taskroot').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('project') }}/"+ task + "/tasks/create", {}, function (task) {
                $('#taskdetail').html(task);
            });
        });

        $('button.taskdestroy').click(function () {
            var task = this.getAttribute('data-id');
            bootbox.confirm("Vous allez supprimer cette tâches ? ", function (result) {
                //Example.show("Confirm result: "+result);
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('tasks') }}/" + task + "/destroy",
                        data: task,
                        success: function (task) {
                            location.reload();
                            $('#taskdetail').html(task);
                        }
                    });
                }
            });

        });
    });
</script>

</body>
</html>
