<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DurationsTask extends Model {

    /**
     * Generated
     */

    protected $table = 'durations_tasks';
    protected $fillable = ['id', 'startdate', 'enddate', 'user_task_id'];


    public function usersTask() {
        return $this->belongsTo(\App\Models\UsersTask::class, 'user_task_id', 'id');
    }


}
