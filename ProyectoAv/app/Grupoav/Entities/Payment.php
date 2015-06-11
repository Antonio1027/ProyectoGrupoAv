<?php

namespace Grupoav\Entities;

class Payment extends \Eloquent {
	protected $fillable = ['amount',
						   'description',
						   'number'];

	public function order(){
		return $this->belongsTo('Grupoav\Entities\Order');		
	}

	public function countPayments($id){
		return $this->where('order_id','=',$id)->count();
	}
}