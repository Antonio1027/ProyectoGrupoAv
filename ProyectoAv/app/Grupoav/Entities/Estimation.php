<?php

namespace Grupoav\Entities;



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
						   "contact",
						   "subtotal",
						   "deposit",
						   "total",
						   "advanced_payment",
						   "balance",
						   "discount"];

	public function types(){
		return $this->belongsToMany("Grupoav\Entities\Type")->withPivot('quantity')->withTimestamps();
	}

	public function delete(){

		if(count($this->types) > 0){
			$this->types()->detach();
		}

		return parent::delete();
	}

}