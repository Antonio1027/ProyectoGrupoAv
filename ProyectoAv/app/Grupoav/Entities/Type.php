<?php

namespace Grupoav\Entities;

class Type extends \Eloquent {
	protected $fillable = [ 'name',
							'rental_price',
							'product_id'];

	public function estimations(){
		return $this->belongsToMany('Grupoav\Entities\Estimation')->withPivot('quantity')->withTimestamps();		
	}
}