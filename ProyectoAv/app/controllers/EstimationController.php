<?php 

use Grupoav\Repositories\EstimationRepo;

class EstimationController extends BaseController
{	
	protected $estimationRepo;

	function __construct(EstimationRepo $estimationRepo)
	{
		$this->estimationRepo = $estimationRepo;
	}

	public function getEstimations(){
		$estimations = $this->estimationRepo->allEstimations();
		if($estimations->count())
			return Response::json(array('data' => $estimations),200);
		return Response::json(array('errors' => array('msg'=>array('No se encontraron resultados'))),422);//solicitud no procesada
	}

	public function getEstimation($id){
		$estimation = $this->estimationRepo->findEstimation($id);		
		$data = $estimation->toArray();
		$types = array();		
		foreach ($estimation->types as $key => $type) {
			$types[$key]['name'] = $type->name;
			$types[$key]['subtotal'] = ($type->pivot->quantity * $type->rental_price);			
			$types[$key]['rental_price'] = $type->rental_price;
			$types[$key]['quantity'] = $type->pivot->quantity;			
			$types[$key]['product'] = $type->product->name;			
			$types[$key]['category'] = $type->product->category->name;
		}		
			
		if($estimation)
			return Response::json(array('data' => $data,'types'=>$types),200);
		return Response::json(array('errors' => array('msg' => array('No se encontraron resultados'))),422);
	}

	public function printEstimation($id,$token){		
		try {
			$user = JWTAuth::toUser($token);			

			$estimation = $this->estimationRepo->findEstimation($id);

			$estimation->date_event = $estimation->formatDate( $estimation->date_event );
			$estimation->date_collecting = $estimation->formatDate( $estimation->date_collecting );
			$estimation->date_range = $estimation->formatDate( $estimation->date_range );
			$date = new DateTime($estimation->created_at);
			$estimation->date_created = $date->format('d-m-Y');
			
			if($estimation){
				$html = View::make("emails.formatestimation",compact('estimation'));			
		    	return PDF::load($html, 'A4', 'portrait')->show();				    	
		    }
		    return Redirect::to('/#/presupuestos');	
		} catch (Exception $e) {
    		return Redirect::to('/#/presupuestos');
		}		
	}	
}

?>