<?php 

namespace Grupoav\Managers;

class NewType extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required',
					   'rental_price' => 'required',
					   'product_id' => 'required',					   
						'reserve'	=> 'required',
						'total'	=> 'required');
		return $rules;
	}	
}

?>