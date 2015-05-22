<?php

namespace Grupoav\Entities;

class Order extends \Eloquent {
	protected $fillable = ['estimation_id','available_facture','status'];

	public function estimation(){
		return $this->hasOne('Grupoav\Entities\Estimation');
	}
}