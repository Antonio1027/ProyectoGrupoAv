<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Order;
use Grupoav\Entities\Estimation;

class OrderRepo extends \Eloquent
{
	public function newOrder($estimation_id){
		$order = new Order();
		$order->estimation_id = $estimation_id;
		return $order;
	}

	public function allOrders(){
		return Estimation::has('order')->with('order')->get();
	}
}

?>