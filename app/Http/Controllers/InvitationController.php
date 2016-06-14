<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Invitation;
use App\Models\Project;
use App\Models\ProjectsUser;
use App\Models\User;

class InvitationController extends Controller
{
    // Return the invitation view to the user connected
    public function show(Request $request)
    {
        return view('invitation.show', ['project' => $request->projectid, 'hostid' => Auth::user()->id]);
    }

    // Create an invitation
    public function store(Request $request)
    {
        if (User::find($request->input('guest_id'))) { //Verify if the user id exists

            $project = Project::find($request->input('project_id')); // Recover the id of projet in the variable $project
            $checkinvite = Invitation::where('project_id', '=', $request->input('project_id'))->where('guest_id', '=', $request->input('guest_id'))->get(); // Recover the information stored in the form

            if ($checkinvite->isEmpty()) { //Verify if
                foreach ($project->users as $user) {
                    if ($user->id != $request->input('guest_id')) {

                        // Create and spend a invitation to guest user in status "Wait"
                        $invitation = new Invitation;
                        $invitation->guest_id = $request->input('guest_id');
                        $invitation->host_id = $request->input('host_id');
                        $invitation->project_id = $request->input('project_id');
                        $invitation->status = "Wait";
                        $invitation->save();

                        (new EventController())->store($request->input('project_id'), "Inviter un utilisateur");

                        return redirect('project/' . $request->input('project_id'));
                    } else { // Return a error message if the user is already exists
                        return "Utilisateur déja dans le projet";
                    }
                }
            } else { // Return a error message if the user is invited
                return "Utilisateur déja invité";
            }
        } else { // Return a error message if the id user doesn't exists
            return "Utilisateur non trouvé";
        }
    }

    // Return the view about the waiting invitations
    public function wait($id)
    {
        $wait = Invitation::where('project_id', '=', $id)->get();
        return view('invitation.wait', ['wait' => $wait]);
    }

    // Return the edition view
    public function edit()
    {
        $invitations = Invitation::where("guest_id", "=", Auth::user()->id)->get();
        return view('invitation.edit', ['invitations' => $invitations]);
    }

    // Accept a invitation
    public function accept(Invitation $invitation)
    {
        // Change the status in "Accept"
        $invitation->update([
            'status' => 'Accept'
        ]);

        (new EventController())->store($invitation->project_id, " accepter l'invitation"); // Create an event

        // Add the user in the project
        $liaison = new ProjectsUser();
        $liaison->project_id = $invitation->project_id;
        $liaison->user_id = Auth::user()->id;
        $liaison->save();
    }

    // Refuse a invitation
    public function refuse(Invitation $invitation)
    {
        // Change the status in "Refuse"
        $invitation->update([
            'status' => 'Refuse'
        ]);

        (new EventController())->store($invitation->project_id, " refuser l'invitation"); // Create an event
    }
}
