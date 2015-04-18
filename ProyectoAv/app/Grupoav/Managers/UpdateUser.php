<?php 

namespace Grupoav\Managers;

class UpdateUser extends BaseManager
{
	public function getRules(){
		$rules = array('name' 				   => 'required',
				       'email' 				   => 'required|email|unique:users,email,' . $this->entity->id,
				       'password' 			   => 'required',
				       'password_confirmation' => 'required',
				       'movil' 				   => 'required');
		return $rules;
	}
}

?>