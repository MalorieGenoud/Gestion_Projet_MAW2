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

        Route::get('/', function(){
            return view('project');
        });

        Route::resource('project','ProjectController',
            ['parameters' => ['project' => 'id']], 
            ['only' => ['index']]
        );

        Route::get('project/{id}', 'ProjectController@show')->where('id', '[0-9]+');
        Route::get('project/{id}/task', 'ProjectController@task')->where('id', '[0-9]+');
        Route::get('project/{id}/files', 'ProjectController@files')->where('id', '[0-9]+');

        Route::get('logout', 'SessionController@destroy');

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
