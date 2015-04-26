<?php

namespace Grupoav\Entities;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Type extends \Eloquent {

	use SoftDeletingTrait;
	
	protected $fillable = [ 'name',
							'rental_price',
							'product_id'];

	protected $dates = ['deleted_at'];
	public function estimation(){
		return $this->belongsToMany('Grupoav\Entities\Estimation')->withPivot('quantity')->withTimestamps();		
	}
	public function product(){
		return $this->belongsTo('Grupoav\Entities\Product');
	}
}