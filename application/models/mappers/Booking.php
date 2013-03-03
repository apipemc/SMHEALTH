<?php
/**
 * Application Model Mapper Booking
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Mappers\Booking
 */
class Application_Model_Mapper_Booking
{
	protected $_dbtable;
	
	public function setDbTable($dbTable){
		if(is_string($dbTable)){
			$dbTable = new $dbTable;
		}
	
		if (!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Tabla de entrada proporciona los datos invalidos');
		}
	
		$this->_dbtable = $dbTable;
		return $this;
	}
	
	public function getDbTable(){
		if (null === $this->_dbtable){
			$this->setDbTable('Application_Model_DbTable_Booking');
		}
		return $this->_dbtable;
	}
	
	public function save(Application_Model_Booking $model){
	
		$data = array('Reservationdate'=> $model->getReservationdat(),
					  'DoctorId'       => $model->getDoctorid(),
					  'PatientId'      => $model->getPatientid(),
					  'UserId'     	   => $model->getUserid(),
					  'Status'   	   => $model->getStatus());
	
		if (null === ($id = $model->getBookingid())){
			unset($data['BookingId']);
			$this->getDbTable()->insert($data);
		}else{
			$this->getDbTable()->update($data, array('BookingId = ?' => $id));
		}
	}
	
	public function find($id, Application_Model_Booking $model){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
	
		$row = $result->current();
		$model->setBookingid($row->BookingId)
			  ->setReservationdate($row->Reservationdate)
			  ->setDoctorid($row->DoctorId)
			  ->setPatientid($row->PatientId)
			  ->setUserid($row->UserId)
			  ->setStatus($row->Status);
	}
	
	public function fetchAll($where, $order, $count, $offset){
	
		$resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
		$entries   = array();
		foreach ($resultSet as $row){
	
			$entry = new Application_Model_Booking;
			$entry->setBookingid($row->BookingId)
			  	  ->setReservationdate($row->Reservationdate)
			 	  ->setDoctorid($row->DoctorId)
			 	  ->setPatientid($row->PatientId)
			 	  ->setUserid($row->UserId)
			 	  ->setStatus($row->Status);
			$entries[] = $entry;
		}
		return $entries;
	}
}