<?php 

namespace Grupoav\Managers;

class NewEstimation extends BaseManager
{
	public function getRules(){
		$rules = array('costumer_name'	=>	'required',
					   'date_event'		=>	'required | date',
					   'event_address'	=>	'required',
					   'home_address'	=>	'required',
					   'phone'			=>	'required',
					   'movil'			=>	'required',					   
					   'date_range'		=>	'required | date',
					   'date_collecting'=>	'required | date',
					   'type'			=>	'required',
					   'number_people'	=>	'required',
					   'color'			=>	'required',					   
					   'subtotal'		=>	'required',
					   'deposit'		=>	'required',
					   'total'			=>	'required',
					   'advanced_payment'=>	'required',
					   'balance'		=>	'required',
					   'discount'		=>	'required');
		return $rules;
	}	
	public function prepareData($data){
		if(isset($data['id']))
			unset($data['id']);
		return $data;
	}
}

?>