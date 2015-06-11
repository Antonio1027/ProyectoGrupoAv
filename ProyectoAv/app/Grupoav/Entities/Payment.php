<?php

namespace Grupoav\Entities;

class Payment extends \Eloquent {
	protected $fillable = ['amount',
						   'description'];

	public function order(){
		return $this->belongsTo('Grupoav\Entities\Order');		
	}
}