<?php  

namespace Grupoav\Managers;

class NewExtratype extends BaseManager
{
	public function getRules(){
		$rules = [
			'quantity' 		=> 'required',
			'name' 			=> 'required',
			'total' 		=> 'required',
			'estimation_id' => 'required'
		];

		return $rules;
	}

	public function prepareData($data){
		return $data;
	}
}

?>