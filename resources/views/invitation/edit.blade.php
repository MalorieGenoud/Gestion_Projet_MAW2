<table class="table">
    <tr>
        <th>id</th>
        <th>token</th>
        <th>statut</th>
        <th>guest_id</th>
        <th>host_id</th>
        <th>project_id</th>
        <th>created_at</th>
        <td>action</td>
    </tr>

    @foreach($invitations as $invitation)

        <tr>
            <td>{{$invitation->id}}</td>
            <td>{{$invitation->token}}</td>
            <td>{{$invitation->statut}}</td>
            <td>{{$invitation->guest_id}}</td>
            <td>{{$invitation->host_id}}</td>
            <td>{{$invitation->project_id}}</td>
            <td>{{$invitation->created_at}}</td>
            <td> <button style="float: left;padding: 3px 6px;;" class="left btn taskedit" data-id=""> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </button>
                <button style="float: left;padding: 3px 6px;;" class="left btn taskplus" data-id=""> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
            </td>
        </tr>

    @endforeach

</table>