<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectsUser;
use Auth;
use Illuminate\Support\Facades\Input;
use Storage;
use Validator;

use App\Http\Requests;

class UserController extends Controller
{
    public function show(User $user, Request $request)
    {
        //dd($request->file());
        return view('user.show', ['user' => $user]);
    }

    public function storeAvatar(User $user, Request $request)
    {

        $file = Input::file('avatar');

        $destinationPath = 'avatar/';

        $fileArray = array('image' => $file);

        $rules = array(
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        );

        $validator = Validator::make($fileArray, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        } else {
            $extension = $file->getClientOriginalExtension();
            $fileName = md5(date('YmdHis') . rand(11111, 99999)) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $user->update(['avatar' => $fileName]);
        };

        return redirect("user/" . Auth::user()->id);

    }
}
