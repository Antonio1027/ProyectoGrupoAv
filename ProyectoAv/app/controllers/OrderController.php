<?php 

use Grupoav\Repositories\OrderRepo;

class OrderController extends BaseController
{
	protected $orderRepo;
	function __construct(OrderRepo $orderRepo)
	{
		$this->orderRepo = $orderRepo;
	}

	public function getOrders(){
		$orders = $this->orderRepo->allOrders();
		if($orders->count())
			return Response::json(array('data' => $orders),200);
		else
			return Response::json(array('errors' => array('msg' => 'No se encontraron resultados')),422);
	}
}

?>