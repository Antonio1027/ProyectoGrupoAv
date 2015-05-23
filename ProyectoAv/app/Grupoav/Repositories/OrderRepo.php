<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Order;
use Grupoav\Entities\Estimation;

class OrderRepo extends \Eloquent
{
	public function newOrder($estimation_id){
		$order = new Order();
		$order->estimation_id = $estimation_id;
		$order->status = 1;
		return $order;
	}

	public function allOrders(){
		return Estimation::has('order')->with('order')->get();
	}

	public function findOrder($id){
		return Order::find($id);
	}

	public function findOrderWithTypes($id){
		return Order::with('estimation.types.product.category')
					->where('id','=',$id)
					->get();
	}
}

?>