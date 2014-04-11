<?php

class Test extends Eloquent{
    protected $table = 'tests';

    public function proctor(){
        return $this->belongsTo('Proctor', 'proctor_id');
    }

    public function project(){
        return $this->belongsTo('Project', 'project_id');
    }

}
?>