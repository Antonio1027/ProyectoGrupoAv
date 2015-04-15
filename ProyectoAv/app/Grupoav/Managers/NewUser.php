<?php 

namespace Grupoav\Managers;

class NewUser extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required',
					   'email' => 'required | unique:users',
					   'password' => 'required | confirmed',
					   'movil' => 'required');
		return $rules;
	}
}

?>