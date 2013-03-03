<?php
/**
 * Application Model Mapper SpecializationXDoctor
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Mappers\SpecializationXDoctor
 */
class Application_Model_Mapper_SpecializationXDoctor
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
			$this->setDbTable('Application_Model_DbTable_SpecializationXDoctor');
		}
		return $this->_dbtable;
	}
	
	public function save(Application_Model_SpecializationXDoctor $model){
	
		$data = array('SpecializationId' => $model->getSpecializationid(),
					  'DoctorId'      	 => $model->getDoctorid());
	
		if (null === ($id = $model->getSpecializationxdoctorid())){
			unset($data['SpecializationXdoctorId']);
			$this->getDbTable()->insert($data);
		}else{
			$this->getDbTable()->update($data, array('SpecializationXdoctorId = ?' => $id));
		}
	}
	
	public function find($id, Application_Model_SpecializationXDoctor $model){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
	
		$row = $result->current();
		$model->setSpecializationxdoctorid($row->SpecializationXdoctorId)
			  ->setSpecializationid($row->SpecializationId)
			  ->setDoctorid($row->DoctorId);
	}
	
	public function fetchAll($where, $order, $count, $offset){
	
		$resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
		$entries   = array();
		foreach ($resultSet as $row){
	
			$entry = new Application_Model_SpecializationXDoctor;
			$entry->setSpecializationxdoctorid($row->SpecializationXdoctorId)
			      ->setSpecializationid($row->SpecializationId)
			      ->setDoctorid($row->DoctorId);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function delete($id){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
		$row = $result->current();
		$row->delete();
	}
}