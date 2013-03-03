<?php
/**
 * Application Model Booking
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Booking
 */
class Application_Model_Booking
{
	protected $_bookingid;
	protected $_reservationdate;
	protected $_doctorid;
	protected $_patientid;
	protected $_userid;
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
			throw new Exception('Propiedad no validad en Booking');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Propiedad no validad en Booking');
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
	
	public function setBookingid($int){
		$this->_bookingid = (int)$int;
		return $this;
	}
	
	public function getBookingid(){
		return $this->_bookingid;
	}
	
	public function setReservationdate($timestamp){
		$this->_reservationdate = $timestamp;
		return $this;
	}
	
	public function getReservationdat(){
		return $this->_reservationdate;
	}
	
	public function setDoctorid($int){
		$this->_doctorid = (int)$int;
		return $this;
	}
	
	public function getDoctorid(){
		return $this->_doctorid;
	}
	
	public function setPatientid($int){
		$this->_patientid = (int)$int;
		return $this;
	}
	
	public function getPatientid(){
		return $this->_patientid;
	}
	
	public function setUserid($int){
		$this->_userid = (int)$int;
		return $this;
	}
	
	public function getUserid(){
		return $this->_userid;
	}
	
	public function setStatus($int){
		$this->_status = (int)$int;
		return $this;
	}
	
	public function getStatus(){
		return $this->_status;
	}
	
	public function toArray(){
		return array('BookingId' 	  => $this->getBookingid(),
					 'Reservationdate'=> $this->getReservationdat(),
					 'DoctorId'       => $this->getDoctorid(),
					 'PatientId'      => $this->getPatientid(),
					 'UserId'     	  => $this->getUserid(),
					 'Status'   	  => $this->getStatus());
	}
	
	public function setMapper(Application_Model_Mapper_Booking $mapper){
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper(){
		if (null === $this->_mapper){
			$this->setMapper(new Application_Model_Mapper_Booking);
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