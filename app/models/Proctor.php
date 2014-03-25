<?php

class Proctor extends Eloquent{
    protected $table = 'proctors';

    public function tests(){
        return $this->hasMany('Test', 'proctor_id');
    }

    public function project(){
        return $this->belongsTo('Project', 'project_id');
    }

}
?>