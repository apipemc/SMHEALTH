<?php
/**
 * Application Model Mapper Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Mappers\Patient
 */
class Application_Model_Mapper_Patient
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
			$this->setDbTable('Application_Model_DbTable_Patient');
		}
		return $this->_dbtable;
	}
	
	public function save(Application_Model_Patient $model){
	
		$data = array('Identification'=> $model->getIdentification(),
					  'Birthday'      => $model->getBirthday(),
					  'Phone'         => $model->getPhone(),
					  'Observation'   => $model->getObservation());
	
		if (null === ($id = $model->getPatientid())){
			unset($data['PatientId']);
			$this->getDbTable()->insert($data);
		}else{
			$this->getDbTable()->update($data, array('PatientId = ?' => $id));
		}
	}
	
	public function find($id, Application_Model_Patient $model){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
	
		$row = $result->current();
		$model->setPatientid($row->PatientId)
			  ->setIdentification($row->Identification)
			  ->setBirthday($row->Birthday)
			  ->setPhone($row->Phone)
			  ->setObservation($row->Observation);
	}
	
	public function fetchAll($where, $order, $count, $offset){
	
		$resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
		$entries   = array();
		foreach ($resultSet as $row){
	
			$entry = new Application_Model_Patient;
			$entry->setPatientid($row->PatientId)
				  ->setIdentification($row->Identification)
				  ->setBirthday($row->Birthday)
				  ->setPhone($row->Phone)
				  ->setObservation($row->Observation);
			$entries[] = $entry;
		}
		return $entries;
	}
}