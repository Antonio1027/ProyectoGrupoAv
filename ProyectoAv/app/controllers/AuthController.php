<?php  

class AuthController extends BaseController
{	
	public function signin(){

		$credentials = Input::only('username','password');		
		if(! $token = JWTAuth::attempt($credentials))
			return Response::json(array('errors' => array('msg'=>array('Verifique nombre de usuario y/o contraseña'))),402);

		$user = JWTAuth::toUser($token);
		$userType = $user->type;

		return Response::json(compact('token','userType'));
	}
}

?>