<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\File;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Storage;
use Validator;
use App\Http\Requests;

class FileController extends Controller
{
    public function show(){

    }

    public function store(Project $project, Request $request, $id)
    {


        $file = Input::file('file');

        $destinationPath = 'files/';

        $fileArray = array('files' => $file);

        $rules = array(
            'files' => 'required|max:10000'
        );

        $validator = Validator::make($fileArray, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        } else {
            $extension = $file->getClientOriginalExtension();
//            dd($file->getClientOriginaName());
            $fileName = md5(date('YmdHis') . rand(11111, 99999)) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $store = new File;
            $store->name = "test";
            $store->description = $request->input('description');
            $store->url = $fileName;
            $store->project_id = $id;
            $store->save();
        };

        return redirect("project/" . $id);

    }
}
