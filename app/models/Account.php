<?php

class Account extends Eloquent{
    protected $table = 'accounts';

    public function users(){
        return $this->hasMany('User', 'account_id');
    }

}
?>