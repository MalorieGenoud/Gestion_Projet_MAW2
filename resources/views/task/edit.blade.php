
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/tasks/'.$task->id) }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Nom de la tâche</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{$task->name}}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Durée de la tâche</label>

                <div class="col-md-6">
                    <input type="time" class="form-control" name="duration" value="{{$task->duration}}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Date de début</label>

                <div class="col-md-6">
                    <input type="date" class="form-control" name="date_jalon" value="{{ $task->date_jalon }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Statut</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="statut" value="{{ $task->statut }}" required>
                </div>
            </div>




            <div class="form-group">
                <label class="col-md-4 control-label">Parent id</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="parent_id" value="{{ $task->parent_id }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Créer
                    </button>

                </div>
            </div>
        </form>
