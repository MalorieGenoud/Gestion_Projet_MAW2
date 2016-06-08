<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class FileController extends Controller
{
    public function show(){

    }

    public function store(Project $project, Request $request)
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
