<?php
/**
 * Application Model Specialization
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Specialization
 */
class Application_Model_Specialization
{
	protected $_specializationid;
	protected $_name;
	protected $_status;
	
	protected $_mapper;
	
	public function __construct(array $options = null){
		if(is_array($options)){
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value){
		$method = 'set'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Specialization');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Specialization');
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
	
	public function setSpecializationid($int){
		$this->_specializationid = (int)$int;
		return $this;
	}
	
	public function getSpecializationid(){
		return $this->_specializationid;
	}
	
	public function setName($text){
		$this->_name = (string)$text;
		return $this;
	}
	
	public function getName(){
		return $this->_name;
	}
	
	public function setStatus($int){
		$this->_status = (int)$int;
		return $this;
	}
	
	public function getStatus(){
		return $this->_status;
	}
	
	public function toArray(){
		return array('SpecializationId' => $this->getSpecializationid(),					
					 'Name'         	=> $this->getName(),					
					 'Status'           => $this->getStatus());
	}
	
	public function setMapper(Application_Model_Mapper_Specialization $mapper){
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper(){
		if (null === $this->_mapper){
			$this->setMapper(new Application_Model_Mapper_Specialization);
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