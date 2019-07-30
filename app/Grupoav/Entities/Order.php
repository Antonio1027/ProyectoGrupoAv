<?php

namespace Grupoav\Entities;
use DateTime;

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

	public function getCreatedAtAttribute($createdAt)
	{						   
	   $date = new DateTime($createdAt);
	   return $date->format('Y-m-d');
	}

}