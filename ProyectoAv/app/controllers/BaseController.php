<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function renameIndex($array){
		$array = array_map(function($tag){
			return array(
				'type_id' => $tag['id'],
				'quantity'=> $tag['quantity']
			);		
		},$array);		
		return $array;
	}

	public function restoreReserve($types){
		foreach ($types as $key => $type) {
			$type->reserve = $type->reserve + $type->pivot->quantity;
			if( ! $type->save())
				return false;
		}
		return true;					
	}

}
