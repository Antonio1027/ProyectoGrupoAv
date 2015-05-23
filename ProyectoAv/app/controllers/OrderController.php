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

	public function getOrder($id){
		$order = $this->orderRepo->findOrderWithTypes($id);
		if($order)
			return Response::json(array('data' => $order),200);
		else
			return Response::json(array('errors' => array('msg' => 'No se encontraron resultados')),422);
	}

	public function updateFacture(){
		$order = $this->orderRepo->findOrder(Input::get('id'));		
		if($order){
			$order->available_facture = Input::get('facture');
			if($order->save())
				return Response::json(array('success' => array('msg' => 'Orden actualizada')),200);	
			else
				return Response::json(array('errors' => array('msg' => 'Ocurrio un error')),422);	
		}
		return Response::json(array('errors' => array('msg' => 'No se encontraron resultados')),422);
	}

	public function printOrder($id){
		$order = $this->orderRepo->findOrder($id);
		if($order){
			$html = View::make('emails.formatOrder',compact('order'));
			return PDF::load($html, 'A4', 'portrait')->show();
		}
		else
			return Response::json(array('errors' => array('msg' => 'No se encontraron resultados')),422);		
	}

	public function updateStatus(){
		$data = Input::all();
		$order = $this->orderRepo->findOrder((int)$data['id']);		
		if($order){
			if($order->status > 2 || $order->status < 0){
				return Response::json(array('errors' => array('msg' => 'Error al actualizar')),422);
			}

			$order->status =  $order->status + 1;
			if($order->save())
				return Response::json(array('success' => array('msg' => 'Orden actualizada','status' => $order->status)),200);	
			else
				return Response::json(array('errors' => array('msg' => 'Ocurrio un error')),422);				
		}
		else
			return Response::json(array('errors' => array('msg' => 'No se encontraron resultados')),422);
	}
}

?>