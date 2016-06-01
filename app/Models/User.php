<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    /**
     * Generated
     */
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['firstname', 'lastname', 'mail', 'role_id', 'password'];


    public function role() {
        return $this->belongsTo(\App\Models\Role::class, 'role_id', 'id');
    }

    public function projects() {
        return $this->belongsToMany(\App\Models\Project::class, 'projects_users', 'user_id', 'project_id');
    }

    public function guest() {
        return $this->hasMany(\App\Models\Invitation::class, 'guest_id', 'id');
    }

    public function host() {
        return $this->hasMany(\App\Models\Invitation::class, 'host_id', 'id');
    }

    public function projectsUsers() {
        return $this->hasMany(\App\Models\ProjectsUser::class, 'user_id', 'id');
    }

    public function usersTasks() {
        return $this->hasMany(\App\Models\UsersTask::class, 'user_id', 'id');
    }

    public function getActiveTask() {
//        return false;
        return UsersTask::select()->where("users_tasks.user_id", "=", $this->id)->join('durations_tasks','users_tasks.id', '=', 'durations_tasks.user_task_id')->whereNull("durations_tasks.ended_at")->get();



    }
    
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'user_id');
    }
/*
$userTasks = UsersTask::where("user_id", "=", $id)->get();
foreach ($userTasks as $userstask) {
    // $userstask->durationsTasks();
    //dd($userstask->durationsTasks()->get());
foreach ($userstask->durationsTasks()->get() as $durationtask) {
if ($durationtask->ended_at == null) {
return false;
}
}

}
$newActiveTask = new DurationsTask;
$newActiveTask->user_task_id = $query->model->user_task_id;
$newActiveTask->save();
return $newActiveTask->id;
*/
}
