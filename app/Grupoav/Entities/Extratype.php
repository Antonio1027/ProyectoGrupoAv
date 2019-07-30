<?php

namespace Grupoav\Entities;

class Extratype extends \Eloquent {
	protected $fillable = [
					'quantity',
					'name',
					'total',
					'estimation_id'
				];

	public function estimation(){
		return $this->belongsTo('Grupoav\Entities\Estimation');
	}
}

