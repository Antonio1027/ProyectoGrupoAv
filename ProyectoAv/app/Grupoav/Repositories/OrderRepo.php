<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Order;
use Grupoav\Entities\Estimation;
use Grupoav\Entities\Payment;

class OrderRepo extends \Eloquent
{
	public function newOrder($estimation_id){
		$order = new Order();
		$order->estimation_id = $estimation_id;
		$order->status = 0;
		$order->pay = 0;
		return $order;
	}

	public function allOrders(){
		return Estimation::has('order')->with('order')->get();
	}

	public function findOrder($id){
		return Order::find($id);
	}

	public function findOrderWithTypes($id){
		return Order::with('estimation.types.product.category','payments','estimation.extratypes')
					->where('id','=',$id)
					->get();
	}

	public function newPayment($order_id){
		$payment = new Payment();	
		$payment->number = $payment->countPayments($order_id) + 1;
		$payment->order_id = $order_id;
		return $payment;	
	}

	public function allPayments(){
		return Payment::with('order.estimation')->get();
	}

	public function findPayment($id){
		return Payment::find($id);
	}

}

?>