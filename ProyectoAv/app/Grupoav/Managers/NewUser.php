<?php 

namespace Grupoav\Managers;

class NewUser extends BaseManager
{
	public function getRules(){
		$rules = array('name' 		=> 'required',
					   'email' 		=> 'required | unique:users',
					   'movil' 		=> 'required',
					   'password' 	=> 'required | confirmed',
					   'username'	=> 'required | unique:users');
		return $rules;
	}
}

?>