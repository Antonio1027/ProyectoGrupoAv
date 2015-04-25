<?php

namespace Grupoav\Entities;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends \Eloquent {
	use SoftDeletingTrait;
	
	protected $fillable = [ 'name',							
							'category_id'];
	protected $dates = ['deleted_at'];
	
	public function types(){
		return $this->hasMany('Grupoav\Entities\Type');
	}

	public function estimations(){
		return $this->belongsToMany('Grupoav\Entities\Estimation');
	}

	public function delete(){
		if($this->types()->count() > 0){
			foreach($this->types as $type)
	        {
	            $type->delete();
	        
			}
		}	
		return parent::delete();
	}
}