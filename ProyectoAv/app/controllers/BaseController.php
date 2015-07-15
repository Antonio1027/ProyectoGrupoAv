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

	public function calculator($estimation){
		$subtotal = 0;
		$subtotal2 = 0;
		foreach ($estimation->types as $key => $value) {
			$subtotal = ((float)$value->rental_price * (float)$value->pivot->quantity) + (float)$subtotal;
		}
		foreach ($estimation->extratypes as $key => $value) {
			$subtotal2 = $subtotal2 + (float)$value->total;
		}
		$estimation->subtotal = (float)$subtotal + (float)$subtotal2;

		if($estimation->iva){
			$estimation->sub_iva = ($estimation->subtotal - $estimation->discount) * 0.16;
		}

		$estimation->total = $estimation->subtotal - $estimation->discount  + $estimation->sub_iva + $estimation->deposit;
		$estimation->balance = $estimation->total - $estimation->advanced_payment;
		$estimation->save();		
	}

}
