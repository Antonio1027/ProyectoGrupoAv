<?php

namespace Grupoav\Entities;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends \Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	protected $fillable = ['name'];

	public function listproducts(){
		return $this->hasMany('Grupoav\Entities\Product');
	}

	public function delete(){
		if($this->listproducts()->count() > 0){
			foreach($this->listproducts as $product)
	        {
	            $product->delete();
	        
			}
		}
		return parent::delete();
	}
}