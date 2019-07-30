<?php 

namespace Grupoav\Managers;

class UpdateUser extends BaseManager
{
	public function getRules(){
		$rules = array('name' 				   => 'required',
				       'email' 				   => 'required|email|unique:users,email,' . $this->entity->id,
				       'password' 			   => 'confirmed',
				       'password_confirmation' => '',
				       'username'			   => 'required|unique:users,username,' . $this->entity->id,
				       'type'				   => 'required',
				       'movil' 				   => 'required');
		return $rules;
	}
}

?>