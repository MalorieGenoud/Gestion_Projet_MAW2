<table class="table">
    <tr>
        <th>id</th>
        <th>user_id</th>

    </tr>
    @foreach($userstask as $usertask)
      <tr>
          <td>{{$usertask->id}}</td>
          <td>{{$usertask->user_id}}</td>
     </tr>
    @endforeach

</table>