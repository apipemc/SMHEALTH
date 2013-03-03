<?php
/**
 * Application Model SpecializationXDoctor
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\SpecializationXDoctor
 */
class Application_Model_SpecializationXDoctor
{
	protected $_specializationxdoctorid;
	protected $_specializationid;
	protected $_doctorid;
	
	protected $_mapper;

	public function __construct(array $options = null){
		if(is_array($options)){
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value){
		$method = 'set'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Specialization X Doctor');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Specialization X Doctor');
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
	
	public function setSpecializationxdoctorid($int){
		$this->_specializationxdoctorid = (int)$int;
		return $this;
	}
	
	public function getSpecializationxdoctorid(){
		return $this->_specializationxdoctorid;
	}
	
	public function setSpecializationid($int){
		$this->_specializationid = (int)$int;
		return $this;
	}
	
	public function getSpecializationid(){
		return $this->_specializationid;
	}
	
	public function setDoctorid($int){
		$this->_doctorid = (int)$int;
		return $this;
	}
	
	public function getDoctorid(){
		return $this->_doctorid;
	}
	
	public function toArray(){
		return array('SpecializationXdoctorId' 	=> $this->getSpecializationxdoctorid(),
					 'SpecializationId'			=> $this->getSpecializationid(),
					 'DoctorId'      			=> $this->getDoctorid());
	}
	
	public function setMapper(Application_Model_Mapper_SpecializationXDoctor $mapper){
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper(){
		if (null === $this->_mapper){
			$this->setMapper(new Application_Model_Mapper_SpecializationXDoctor());
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

	public function delete($id = null){
		return $this->getMapper()->delete($id);
	}
}