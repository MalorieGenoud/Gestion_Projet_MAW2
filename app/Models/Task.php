<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * Generated
     */

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'duration', 'date_jalon', 'statut', 'priority', 'project_id', 'parent_id'];


    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function usersTasks()
    {
        return $this->hasMany(\App\Models\UsersTask::class, 'task_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Task::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(\App\Models\Task::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function getElapsedDuration()
    {
        $total = 0;
        foreach ($this->usersTasks as $usertask) {
            foreach ($usertask->durationsTasks as $durationTask) {
                if($durationTask->ended_at){
                    $total += strtotime($durationTask->ended_at) - strtotime($durationTask->created_at);
                }
            }
        }

        foreach ($this->children as $child) {
            $total += $child->getElapsedDuration();
        }

        return $total;
    }

    public function ifChildTaskNoValidate($isFirst = true){
        if(!$isFirst && $this->statut != "Validate") return false;
        $children_activated = true;
        foreach ($this->children as $child){
            if(!$child->ifChildTaskNoValidate(false)){
                $children_activated = false;
            }
        }
        return $children_activated;
    }


}
