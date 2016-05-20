<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    /**
     * Generated
     */

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'duration', 'date_jalon', 'statut', 'priority', 'project_id', 'parent_id'];


    public function project() {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function usersTasks() {
        return $this->hasMany(\App\Models\UsersTask::class, 'task_id', 'id');
    }

    public function usersNotIn(){

    }

    public function parent(){
        return $this->belongsTo(\App\Models\Task::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(\App\Models\Task::class, 'parent_id');
    }

    public function allChildren(){
        return $this->children()->with('allChildren');
    }




}
