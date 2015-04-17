<?php

namespace Grupoav\Entities;

class Type extends \Eloquent {
	protected $fillable = [ 'name',
							'rental_price',
							'product_id'];
}