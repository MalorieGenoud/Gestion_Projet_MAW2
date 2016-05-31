<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'web'], function () {



    //Route::get('/home', 'HomeController@index');
    Route::get('login', 'SessionController@create');
    Route::post('login', 'SessionController@store');

    //Route::auth();
    Route::group(['middleware' => 'auth'], function(){

        /* TASK  */
        Route::resource('tasks', 'TaskController',
            ['parameters' =>
                ['tasks' => 'task']
            ]
        );
        Route::get('tasks/{task}/',['as' => 'tasks.show','uses' => 'TaskController@show'])->where('task', '[0-9]+');
        Route::get('tasks/{task}/children/create', ['as' => 'tasks.createChildren','uses' => 'TaskController@createChildren'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/children/', ['as' => 'tasks.storeChildren','uses' => 'TaskController@storeChildren'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/play', ['as' => 'tasks.play', 'uses' => 'TaskController@play'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/statut', ['as' => 'tasks.statut', 'uses' => 'TaskController@statut'])->where('task', '[0-9]+');
        Route::get('tasks/{task}/users/', ['as' => 'tasks.users', 'uses' => 'TaskController@users'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/users/', ['as' => 'tasks.storeusers', 'uses' => 'TaskController@storeusers'])->where('task', '[0-9]+');
        Route::delete('tasks/{usersTask}/users/', ['as' => 'tasks.usertaskdelete', 'uses' => 'TaskController@usertaskdelete'])->where('usersTask', '[0-9]+');
        Route::post('tasks/{durationsTask}/stop', ['as' => 'tasks.stop', 'uses' => 'TaskController@stop'])->where('durationsTask', '[0-9]+');
        //Route::get('tasks/{task}', 'TaskController@show')->where('task', '[0-9]+');
        //Route::get('tasks/create', 'TaskController@create');
        //Route::get('tasks/{task}/edit', ['as' => 'tasks.edit', 'uses' => 'TaskController@edit'])->where('task', '[0-9]+');
        Route::post('tasks/{task}', 'TaskController@store')->where('task', '[0-9]+');
        //Route::delete('tasks/{task}/destroy', 'TaskController@destroy')->where('task', '[0-9]+');

        /* PROJECT  */
        Route::resource('project','ProjectController',
            ['parameters' => ['project' => 'id']], 
            ['only' => ['index']]
        );
        Route::get('/', 'ProjectController@index');
        Route::get('project/{id}', 'ProjectController@show')->where('id', '[0-9]+');
        Route::get('project/{id}/tasks/create', 'ProjectController@createTask')->where('id', '[0-9]+');
        Route::post('project/{id}/tasks', 'ProjectController@storeTask')->where('id', '[0-9]+');
        Route::post('project/{id}/events', ['as' => 'project.storeevents', 'uses' => 'ProjectController@storeEvents'])->where('id', '[0-9]+');
        Route::get('project/{id}/files', 'ProjectController@files')->where('id', '[0-9]+');
        Route::get('project/{id}/events', ['as' => 'project.events', 'uses' => 'ProjectController@events'])->where('id', '[0-9]+');
        Route::delete('project/{id}/users/{user}/destroy', 'ProjectController@destroyUser')->where('id', '[0-9]+');


        /* APP */
        Route::get('logout', 'SessionController@destroy');


        /* INVITATION PROJECTS */
        Route::get('project/{projectid}/invitations/', 'InvitationController@show')->where('projectid', '[0-9]+');
        Route::get('project/{projectid}/invitations/wait', 'InvitationController@wait')->where('projectid', '[0-9]+');
        Route::post('project/{projectid}/invitations/', 'InvitationController@store')->where('projectid', '[0-9]+');

        Route::get('invitations','InvitationController@edit');
        Route::post('invitations/{invitation}/accept',['as'=> 'invitations.accept','uses'=>'InvitationController@accept'])->where('invitation', '[0-9]+');;
        Route::post('invitations/{invitation}/refuse',['as'=> 'invitations.refuse','uses'=>'InvitationController@refuse'])->where('invitation', '[0-9]+');;


        /*
        Route::group(['prefix' => 'project'], function(){

            Route::get('work', function(){
                return view('projectwork');
            });

            Route::get('/', function(){
                return view('projectinfo');
            });

            Route::get('edit', function(){
                return view('projectedit');
            });

            Route::get('info', function(){
                return view('projectinfo');
            });

        });
        */

    });



});


/*
Route::get('salut', ['middleware' => 'Ip', function(){
    return 'salut les gens';
}]);


Route::group(['prefix' => 'admin', 'middleware' => 'Ip'], function(){


    Route::get('salut', function () {
        return 'Coucou ';
    });


});

Route::get('/projects', function(){
            return view('projectslist');
        });


Route::get('salut/{name}-{id}', ['as' => 'salut',function($name, $id){
    return "Lien :" . route('salut',['name' => $name]);
}])->where('name', '[a-z0-9\-]+')->where('id','[0-9]+');

//dd($route);
/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
Route::get('/', ['as' => 'home', function()
{
    return view('project');
}]);

Route::get('test', ['as' => 'home', function()
{
    return view('test');
}]);

Route::get('article/{n}', function($n) {
   return view('article', ['numero' => $n]);
})->where('n', '[0-9]+');


Route::controller('welcome', 'Welcome');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*


*/
