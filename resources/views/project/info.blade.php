<div class="panel panel-default">
    <div class="panel-heading">Informations projet</div>

    <div class="panel-body">
        <p>Id :{{$project->id}}</p>
        <p>Nom : {{$project->name}}</p>
        <p>Date de début : {{$project->startdate}}</p>
        <p>Description : {{$project->description}}</p>
    </div>

    <div class="panel-heading">Membres du projet</div>

    <div class="panel-body">
        @foreach($project->users as $user)
            <p>
                @include('user.avatar', ['user' => $user])
                <button class="right btn userprojectdestroy" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </p>
        @endforeach
        <a class="btn btn-warning invitation" data-projectid="{{$project->id}}">Ajouter une personne</a>
        <a class="btn btn-warning invitationwait" data-projectid="{{$project->id}}">Voir les invitations en attente</a>

    </div>

    <div class="panel-heading">Objectifs du projet</div>



    <div class="panel-body">
        @foreach($project->targets as $target)
            {{$target->description}}
        @endforeach
        <a class="btn btn-warning target" data-projectid="{{$project->id}}">Ajouter un objectif</a>
    </div>


</div>

