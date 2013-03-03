<?php
/**
 * Application Model Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Patient
 */
class Application_Model_Patient
{
	protected $_patientid;
	protected $_identification;
	protected $_birthday;
	protected $_phone;
	protected $_observation;
	
	protected $_mapper;
	
	public function __construct(array $options = null){
		if(is_array($options)){
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value){
		$method = 'set'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Patient');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Patient');
		}
		$this->$method();
	}
	
	public function setOptions(array $options){
		$methods = get_class_methods($this);
		foreach ($options as $key => $value){
			$method = 'set'.ucfirst($key);
			if(in_array($method, $methods)){
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setPatientid($int){
		$this->_patientid = (int)$int;
		return $this;
	}
	
	public function getPatientid(){
		return $this->_patientid;
	}
	
	public function setIdentification($int){
		$this->_identification = (int)$int;
		return $this;
	}
	
	public function getIdentification(){
		return $this->_identification;
	}
	
	public function setBirthday($datetime){
		$this->_birthday = $datetime;
		return $this;
	}
	
	public function getBirthday(){
		return substr($this->_birthday,0,10);
	}
	
	public function setPhone($text){
		$this->_phone = (string)$text;
		return $this;
	}
	
	public function getPhone(){
		return $this->_phone;
	}
	
	public function setObservation($text){
		$this->_observation = (string)$text;
		return $this;
	}
	
	public function getObservation(){
		return $this->_observation;
	}
	
	public function toArray(){
		return array('PatientId' 	 => $this->getPatientid(),
					 'Identification'=> $this->getIdentification(),
					 'Birthday'      => $this->getBirthday(),
					 'Phone'         => $this->getPhone(),
					 'Observation'   => $this->getObservation());
	}
	
	public function setMapper(Application_Model_Mapper_Patient $mapper){
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper(){
		if (null === $this->_mapper){
			$this->setMapper(new Application_Model_Mapper_Patient);
		}
		return $this->_mapper;
	}
	
	public function save(){
		$this->getMapper()->save($this);
	}
	
	public function find($id){
		$this->getMapper()->find($id, $this);
		return $this;
	}
	
	public function fetchAll($where = null, $order = null, $count = null, $offset = null){
		return $this->getMapper()->fetchAll($where, $order, $count, $offset);
	}
}