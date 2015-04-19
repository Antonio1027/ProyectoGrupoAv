<?php 

use Grupoav\Repositories\UserRepo;

class UserController extends BaseController
{
	function __construct(UserRepo $userRepo){
		$this->userRepo = $userRepo;
	}

	public function getUsers(){
		$users = $this->userRepo->getUsers();
		if($users->count())
			return Response::json($users);		
		return Response::json(array('errors' => array('msg' => 'No se encontraron resultado')),422);
	}

}

?>