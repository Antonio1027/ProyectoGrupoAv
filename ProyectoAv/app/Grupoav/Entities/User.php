<?php

namespace Grupoav\Entities;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface{

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = [];	

	public function setPasswordAttribute($value){
		if( ! empty($value)){			
			$this->attributes['password'] = \Hash::make($value);			
		}
	}						   	
}