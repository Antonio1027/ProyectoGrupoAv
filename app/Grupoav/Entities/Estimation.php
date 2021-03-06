<?php

namespace Grupoav\Entities;
use DateTime;


class Estimation extends \Eloquent {
	protected $fillable = ["costumer_name"   ,
						   "date_event",
						   "event_address",
						   "home_address",
						   "phone",
						   "movil",
						   "email",
						   "date_range",
						   "date_collecting",
						   "type",
						   "number_people",
						   "color",
						   "rfc",
						   "subtotal",
						   "sub_iva",
						   "deposit",
						   "total",
						   "advanced_payment",
						   "balance",
						   "discount",
						   "iva",
						   "buffete"
						   ];

	public function types(){
		return $this->belongsToMany('Grupoav\Entities\Type')->withPivot('quantity')->withTimestamps();
	}

	public function order(){
		return $this->hasOne('Grupoav\Entities\Order');
	}

	public function delete(){

		if(count($this->types) > 0){
			$this->types()->detach();
		}

		return parent::delete();
	}	

	public function extratypes(){
		return $this->hasMany('Grupoav\Entities\Extratype');
	}

	// public function getCreatedAtAttribute($createdAt)
	// {						   	   
	//    $date = new DateTime($createdAt);
	//    return $date->format('Y-m-d');
	// }
	
	public function formatDate($date){		
		$date = explode("T", $date)[0];
		list($año, $mes, $dia) = explode("-", $date);
		$date = $dia . "-" . $mes . "-" . $año;				
		return $date;
	}
}