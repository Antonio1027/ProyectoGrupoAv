<?php

namespace Grupoav\Entities;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface{

	use UserTrait, RemindableTrait;
	
	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = [ 'name',
							'email',
							'password',
							'movil',
							'type',
							'username'];

	public function setPasswordAttribute($value){
		if( ! empty($value)){			
			$this->attributes['password'] = \Hash::make($value);			
		}
	}						   	
}