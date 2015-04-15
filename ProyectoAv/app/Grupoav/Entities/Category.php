<?php

namespace Grupoav\Entities;

class Category extends \Eloquent {
	protected $fillable = ['name'];

	public function listproducts(){
		return $this->hasMany('Grupoav\Entities\Product');
	}
}