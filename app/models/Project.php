<?php

class Project extends Eloquent{
    protected $table = 'projects';

    public function tests(){
        return $this->hasMany('Test', 'project_id');
    }

    public function proctors(){
        return $this->hasMany('Proctor', 'project_id');
    }

    public function account(){
        return $this->belongsTo('Account', 'account_id');
    }

}
?>