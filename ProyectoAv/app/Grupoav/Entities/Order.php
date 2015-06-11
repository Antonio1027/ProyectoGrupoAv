<?php

namespace Grupoav\Entities;

class Order extends \Eloquent {
	protected $fillable = ['estimation_id','available_facture','status',
							'pay',
						   	"observations"];

	public function estimation(){
		return $this->belongsTo('Grupoav\Entities\Estimation');
	}

	public function payments(){
		return $this->hasMany('Grupoav\Entities\Payment');
	}
}