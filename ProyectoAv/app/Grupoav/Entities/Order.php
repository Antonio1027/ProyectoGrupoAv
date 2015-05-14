<?php

namespace Grupoav\Entities;

class Order extends \Eloquent {
	protected $fillable = ['estimation_id'];

	public function estimation(){
		return $this->hasOne('Grupoav\Entities\Estimation');
	}
}