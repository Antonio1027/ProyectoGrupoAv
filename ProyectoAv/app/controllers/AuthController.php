<?php  

class AuthController extends BaseController
{	
	public function signin(){

		$credentials = Input::only('username','password');		
		if(! $token = JWTAuth::attempt($credentials))
			return Response::json(array('errors' => array('msg'=>array('Verifique nombre de usuario y/o contraseña'))),402);

		$user = JWTAuth::toUser($token);		
		return Response::json(compact('token','user'),200);
	}
}

?>