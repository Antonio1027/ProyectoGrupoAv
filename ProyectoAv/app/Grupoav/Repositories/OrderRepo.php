<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Order;

class OrderRepo extends \Eloquent
{
	public function newOrder($estimation_id){
		$order = new Order();
		$order->estimation_id = $estimation_id;
		return $order;
	}
}

?>