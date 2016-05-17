<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Invitation;
use App\Models\Project;
use App\Models\User;

class InvitationController extends Controller
{
    public function show(Request $request)
    {

        //dd(Auth::user());

        return view('invitation.show', ['project' => $request->projectid, 'hostid' => Auth::user()->id]);

    }

    public function store(Request $request)
    {
        //dd($request);
        if (User::find($request->input('guest_id'))) {
            $project = Project::find($request->input('project_id'));
            $checkinvite = Invitation::where('project_id', '=', $request->input('project_id'))->where('guest_id', '=', $request->input('guest_id'))->get();
            if ($checkinvite->isEmpty()) {
                //dd(Invitation::where('project_id', '=', $request->input('project_id'))->where('guest_id', '=', $request->input('guest_id')));
                foreach ($project->users as $user) {
                    if ($user->id != $request->input('guest_id')) {

                        $invitation = new Invitation;

                        $invitation->guest_id = $request->input('guest_id');
                        $invitation->host_id = $request->input('host_id');
                        $invitation->project_id = $request->input('project_id');
                        $invitation->statut = "Wait";
                        $invitation->save();

                        return redirect('project/' . $request->input('project_id'));
                    } else {
                        return "Utilisateur déja dans le projet";
                    }
                }
            } else {
                return "Utilisateur déja invité";
            }
        } else {
            return "Utilisateur non trouvé";
        }
    }

    public function wait($id)
    {
        $wait = Invitation::where('project_id', '=', $id)->get();

        return view('invitation.wait', ['wait' => $wait]);

        
    }

    public function edit(){

        $invitations = Invitation::where("statut","=","wait")->where("guest_id", "=" ,Auth::user()->id)->get();
        return view('invitation.edit',['invitations' => $invitations]);
    }
}
