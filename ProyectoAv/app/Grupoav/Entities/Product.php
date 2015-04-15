<?php

namespace Grupoav\Entities;

class Product extends \Eloquent {
	protected $fillable = [ 'name',
							'rental_price',
							'reserve',
							'total',
							'category_id'];

	public function types(){
		return $this->hasMany('Grupoav\Entities\Type');
	}

	public function estimations(){
		return $this->belongsToMany('Grupoav\Entities\Estimation');
	}
}