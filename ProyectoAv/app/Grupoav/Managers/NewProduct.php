<?php 

namespace Grupoav\Managers;

class NewProduct extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required | unique:products',
					   'rental_price' => 'required',
					   'reserve' => 'required',
					   'total' => 'required',
					   'category_id' => 'required');
		return $rules;
	}	
}

?>
