<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    /**
     * Generated
     */

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'duration', 'date_jalon', 'statut', 'priority', 'project_id'];


    public function project() {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function usersTasks() {
        return $this->hasMany(\App\Models\UsersTask::class, 'task_id', 'id');
    }


}
