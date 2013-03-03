<?php
/**
 * Application Model Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Doctor
 */
class Application_Model_Doctor
{
	protected $_doctorid;
	protected $_name;
	protected $_identification;
	protected $_birthday;
	protected $_startime;
	protected $_endtime;
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
			throw new Exception('Propiedad no validad en Doctor');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Doctor');
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
	
	public function setDoctorid($int){
		$this->_doctorid = (int)$int;
		return $this;
	}
	
	public function getDoctorid(){
		return $this->_doctorid;
	}
	
	public function setName($text){
		$this->_name = (string)$text;
		return $this;
	}
	
	public function getName(){
		return $this->_name;
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
	
	public function setStartime($time){
		$this->_startime = $time;
		return $this;
	}
	
	public function getStartime(){
		return $this->_startime;
	}
	
	public function setEndtime($time){
		$this->_endtime = $time;
		return $this;
	}
	
	public function getEndtime(){
		return $this->_endtime;
	}
	
	public function setStatus($int){
		$this->_status = (int)$int;
		return $this;
	}
	
	public function getStatus(){
		return $this->_status;
	}
	
	public function toArray(){
		return array('DoctorId' 	  => $this->getDoctorid(),
					 'Name'     	  => $this->getName(),
					 'Identification' => $this->getIdentification(),
					 'Birthday'       => $this->getBirthday(),
					 'StarTime'       => $this->getStartime(),
					 'EndTime'     	  => $this->getEndtime(),
					 'Status'   	  => $this->getStatus());
	}
	
	public function setMapper(Application_Model_Mapper_Doctor $mapper){
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper(){
		if (null === $this->_mapper){
			$this->setMapper(new Application_Model_Mapper_Doctor);
		}
		return $this->_mapper;
	}
	
	public function save(){
		return $this->getMapper()->save($this);
	}
	
	public function find($id){
		$this->getMapper()->find($id, $this);
		return $this;
	}
	
	public function fetchAll($where = null, $order = null, $count = null, $offset = null){
		return $this->getMapper()->fetchAll($where, $order, $count, $offset);
	}	
}