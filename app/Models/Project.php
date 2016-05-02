<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * Generated
     */

    protected $table = 'projects';
    protected $fillable = ['name', 'startdate', 'description'];


    public function users() {
        return $this->belongsToMany(\App\Models\User::class, 'projects_users', 'project_id', 'user_id');
    }

    public function files() {
        return $this->hasMany(\App\Models\File::class, 'project_id', 'id');
    }

    public function invitations() {
        return $this->hasMany(\App\Models\Invitation::class, 'project_id', 'id');
    }

    public function projectsUsers() {
        return $this->hasMany(\App\Models\ProjectsUser::class, 'project_id', 'id');
    }

    public function tasks() {
        return $this->hasMany(\App\Models\Task::class, 'project_id', 'id');
    }


}
