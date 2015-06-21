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
			return Response::json($users,200);		
		return Response::json(array('errors' => array('msg' => array('No se encontraron resultado'))),422);
	}

	public function getUser($id){
		$user = $this->userRepo->findUser($id);
		if($user)
			return Response::json($user,200);		
		return Response::json(array('errors' => array('msg' => array('No se encontraron resultado'))),422);	
	}

}

?>