<?php 

namespace Grupoav\Managers;

//clase abstracta para definir el comportamiento de los manejadores

abstract class BaseManager{

	//variables que se envian como parametro al usar un manejador
	protected $entity; //entidad
	protected $data;    //datos de la vista u objeto
	protected $errors; //errores en la validacion del formulario	

	public function __construct($entity, $data){
		$this->entity = $entity;
		$this->data = $data;
	}

	//metodo abstracto para la definicion de reglas de cada manejador
	abstract public function getRules();

	// validacion de los datos enviados
	public function isValid(){

		$rules = $this->getRules();
		$validacion = \Validator::make($this->data, $rules);
		$isValid = $validacion->passes();		
		$this->errors = $validacion->messages();				
		return $isValid;
	}
	//procesar los datos de los datos enviados
	public function prepareData($data){
		return $data;
	}	
	//metodo para guardar el registro de la entidad especificada una vez
	//pasando la validacion
	public function save(){
		if( ! $this->isValid()){
			return false;
		}
		
		$this->entity->fill($this->prepareData($this->data));		
		$this->entity->save();
		return true;
	}

	//obtiene los errores por cada campo del formulario
	public function getErrors(){
		return $this->errors;
	}
}

 ?>