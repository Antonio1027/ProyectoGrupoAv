<?php 

namespace Grupoav\Repositories;

use Grupoav\Entities\User;

class UserRepo extends \Eloquent
{
	public function newUser(){
		$user = new User();
		return $user;
	}

	public function findUser($id){
		$user = User::find($id);
		return $user;
	}

	public function getUsers(){
		return User::all();
	}
}

?>