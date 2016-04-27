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


}
