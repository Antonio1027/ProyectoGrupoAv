<?php 

namespace Grupoav\Managers;

class NewPayment extends BaseManager
{
	public function getRules(){
		$rules = [
			'amount' => 'required',
			'description' => 'required',
			'order_id' => 'required'	
		];
		return $rules;
	}

	public function prepareData($data){
		unset($data['order_id']);		
		return $data;
	}
}

?>