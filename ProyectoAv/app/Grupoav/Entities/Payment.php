<?php
namespace Grupoav\Entities;
use DateTime;

class Payment extends \Eloquent {
	protected $fillable = ['amount',
						   'description',
						   'number'];

	public function order(){
		return $this->belongsTo('Grupoav\Entities\Order');		
	}

	public function countPayments($id){
		return $this->where('order_id','=',$id)->count();
	}

	public function getCreatedAtAttribute($createdAt)
	{						   
	   $date = new DateTime($createdAt);
	   return $date->format('Y-m-d');
	}
}