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
<nav class="navbar navbar-default navbar-static-top ">
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

        <div class="collapse navbar-collapse " id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <!-- Authentication Links -->
            @if (Auth::user())
                <ul class="nav navbar-nav">

                    <li><a>|</a></li>
                    <li>
                        <a href="#" class="invitations">Invitation
                            <?php $total = null; ?>
                            @for($i = 0; $i < count($invitations); $i++)

                                @if($invitations[$i]->guest_id == Auth::user()->id)
                                    <?php $total = $total + 1; ?>
                                @endif

                            @endfor
                            @if($total != null)
                                <span class="badge">{{$total}}</span>
                            @endif
                        </a>
                    </li>
                </ul>


                {{-- Takes the Route name and show the apropriate menu --}}
                @if(Route::current() ->getName() === 'project.show')
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Tout les projets</a></li>
                        <li><a href="{{ url('/project/create') }}">Nouveau projet</a></li>
                    </ul>
                    @endif

                    @endif

                            <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>

                        @else
                            <li><a href="{{route('user.show', Auth::user()->id)}}">{{Auth::user()->fullname}}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                    </li>
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
        $('.tree-menu').ntm();
    });


</script>

<script type="text/javascript">

    $(document).ready(function () {

        // afficher détail de la tache
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

        // Editer une tache
        $('button.taskedit').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ route('tasks.edit', '@') }}".replace('@', task), {}, function (task) {
                bootbox.dialog({
                    title: "Editer une tâche",
                    message: task
                });
            });
        });

        // Ajouter une classe parent
        $('button.taskplus').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task + "/children/create", {}, function (task) {
                bootbox.dialog({
                    title: "Créer une tâche enfant",
                    message: task
                });
            });
        });

        // ajouter tache root
        $('.taskroot').click(function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('project') }}/" + task + "/tasks/create", {}, function (task) {
                bootbox.dialog({
                    title: "Créer une tâche root",
                    message: task
                });
                //$('#taskdetail').html(task);
            });
        });

        // Appeler view pour ajouter utilisateur à la tache
        $('#app-layout').on('click', 'button.taskuser', function () {
            var task = this.getAttribute('data-id');
            $.ajax({
                url: "{{ route('tasks.users', '@') }}".replace('@', task),
                type: 'get',
                success: function (data) {
                    bootbox.dialog({
                        title: "Gestion des utilisateurs de la tâche",
                        message: data
                    });

                }
            });
        });

        // supprimer la tache
        $('button.taskdestroy').click(function () {
            var task = this.getAttribute('data-id');
            bootbox.confirm("Vous allez supprimer cette tâches ? ", function (result) {
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('tasks') }}/" + task,
                        data: task,
                        success: function (task) {
                            //location.reload();
                            $('#taskdetail').html(task);
                        },
                        error: function (task) {
                            console.log(task);
                            $('#taskdetail').html(task);
                        }
                    });
                }
            });

        });

        // supprimer un utilisateur du projet
        $('button.userprojectdestroy').click(function () {
            var id = this.getAttribute('data-id');
            var projectid = this.getAttribute('data-projectid');
            bootbox.confirm("Voulez vous vraiment retirer l'utilisateur du projet ? ", function (result) {
                //Example.show("Confirm result: "+result);
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('project') }}/" + projectid + "/users/" + id + "/destroy",
                        success: function (data) {
                            //alert(data);
                            bootbox.alert("Element supprimer avec succès");
                            $('#taskdetail').html(data);
                        }
                    });
                }
            });

        });


        // inviter un utilisateur
        $('a.invitation').click(function () {
            var projectid = this.getAttribute('data-projectid');
            $.get("{{ url('project') }}/" + projectid + "/invitations", function (projectid) {
                bootbox.dialog({
                    title: "Inviter une personne",
                    message: projectid
                });
            });
        });

        // Ajouter un objectif
        $('#app-layout').on('click', 'a.target', function () {
            var projectid = this.getAttribute('data-projectid');
            $.ajax({
                url: "{{ route('project.gettarget', '@') }}".replace('@', projectid),
                type: 'get',
                success: function (data) {
                   console.log(data);
                }
            });
        });

        // voir les invitations en cours
        $('a.invitationwait').click(function () {
            var projectid = this.getAttribute('data-projectid');
            $.get("{{ url('project') }}/" + projectid + "/invitations/wait", function (projectid) {
                bootbox.dialog({
                    title: "Voir les invitations",
                    message: projectid
                });
            });
        });

        /* $('#main_body').on("click", "#but", function () {
         alert("bla bla");
         });*/

        // lancer un rush sur la tache
        $('#app-layout').on('click', 'button.taskplay', function () {
            var usertaskid = this.getAttribute('data-usertaskid');
            $.ajax({
                url: "{{ route('tasks.play', '@') }}".replace('@', usertaskid),
                type: 'post',
                success: function (data) {

                    if (data == "") {
                        bootbox.dialog({
                            title: "debug",
                            message: "Tache déja en cours"
                        });
                    } else {
                        var button = $('button[data-usertaskid=' + usertaskid + ']');
                        $(button).children().removeClass();
                        button.children().addClass("glyphicon glyphicon-stop");
                        button.removeClass();
                        button.addClass("right btn taskstop btn-lg");
                        button.attr("data-duration", data);
                    }
                }
            });
        });
        // stopper un rush sur la tache
        $('#app-layout').on('click', 'button.taskstop', function () {
            var duration = this.getAttribute('data-duration');
            $.ajax({
                url: "{{ route('tasks.stop', '@') }}".replace('@', duration),
                type: 'post',
                success: function (data) {
                    var button = $('button[data-duration=' + duration + ']');
                    $(button).children().removeClass();
                    button.children().addClass("glyphicon glyphicon-play-circle");
                    button.removeClass();
                    button.addClass("right btn taskplay btn-lg");

                }
            });
        });

        // Appeler les invitations en wait
        $('a.invitations').click(function () {
            callinvitation();
        });

        function callinvitation() {
            $.get("{{ url('invitations') }}", {}, function (invitations) {
                bootbox.dialog({
                    title: "Vos invitations en attentes",
                    message: invitations
                });
            });
        }


        function callEvents(project) {

            $.ajax({
                url: "{{ route('project.events', '@') }}".replace('@', project),
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    //var content = $('#events');
                    //$('#events').html(data);
                    console.log(data);

                    var content = ("<table class='table'><thead><tr><th>Qui</th><th>Description</th><th>Created_at</th></tr></thead>");
                    $.each(data, function (key, data) {
                        content += ("<tr>");
                        content += ("<td>" + this.user_id + "</td>");
                        content += ("<td>" + this.description + "</td>");
                        content += ("<td>" + this.created_at + "</td>");
                        content += ("</tr>");
                    });

                    content += ("</table>");
                    $('#events').append(content);

                }
            });
        }


        $('#app-layout').on('click', 'button.invitationaccept', function () {
            var invitation = this.getAttribute('data-invitation');
            $.ajax({
                url: "{{ route('invitations.accept', '@') }}".replace('@', invitation),
                type: 'post',
                success: function (data) {
                    bootbox.hideAll();
                    callinvitation();
                }
            });
        });

        $('#app-layout').on('click', 'button.invitationrefuse', function () {
            var invitation = this.getAttribute('data-invitation');
            $.ajax({
                url: "{{ route('invitations.refuse', '@') }}".replace('@', invitation),
                type: 'post',
                success: function (data) {
                    bootbox.hideAll();
                    callinvitation();
                }
            });
        });

        // Suppression usertask
        $('#app-layout').on('click', 'button.usertaskdestroy', function () {
            var usertaskdestroy = this.getAttribute('data-id');
            $.ajax({
                url: "{{ route('tasks.usertaskdelete', '@') }}".replace('@', usertaskdestroy),
                type: 'delete',
                success: function (data) {
                    bootbox.hideAll();
                    bootbox.dialog({
                        title: "Suppression participant à la tâche",
                        message: "Participant bien retiré de la tâche"
                    });
                },
                error: function (data) {

                    console.log(data);
                }
            });
        });

        $('#app-layout').on('click', 'button.validate', function () {
            var taskvalidate = this.getAttribute('data-task');
            $.ajax({
                url: "{{ route('tasks.statut', '@') }}".replace('@', taskvalidate),
                type: 'post',
                success: function (data) {
                    bootbox.dialog({
                        title: "Validation de la tâche",
                        message: data
                    });
                },
                error: function (data) {
                    bootbox.dialog({
                        title: "Validation de la tâche",
                        message: data
                    });
                }
            });
        });
        @yield('script')


    });
</script>
<!--
<script>
    // Gantt configuration
    $(".selector").gantt({
        source: "ajax/data.json",
        scale: "weeks",
        minScale: "weeks",
        maxScale: "months",
        onItemClick: function(data) {
            alert("Item clicked - show some details");
        },
        onAddClick: function(dt, rowId) {
            alert("Empty space clicked - add an item!");
        },
        onRender: function() {
            console.log("chart rendered");
        }
    });
</script>
 -->
</body>
</html>
