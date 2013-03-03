<?php
/**
 * Application Model Mapper Specialization
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Mappers\Specialization
 */
class Application_Model_Mapper_Specialization
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
			$this->setDbTable('Application_Model_DbTable_Specialization');
		}
		return $this->_dbtable;
	}
	
	public function save(Application_Model_Specialization $model){
	
		$data = array('Name'	=> $model->getName(),
					  'Status'	=> $model->getStatus());
	
		if (null === ($id = $model->getSpecializationid())){
			unset($data['SpecializationId']);
			$this->getDbTable()->insert($data);
		}else{
			$this->getDbTable()->update($data, array('SpecializationId = ?' => $id));
		}
	}
	
	public function find($id, Application_Model_Specialization $model){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
	
		$row = $result->current();
		$model->setSpecializationid($row->SpecializationId)
			  ->setName($row->Name)
			  ->setStatus($row->Status);
	}
	
	public function fetchAll($where, $order, $count, $offset){
	
		$resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
		$entries   = array();
		foreach ($resultSet as $row){
	
			$entry = new Application_Model_Specialization;
			$entry->setSpecializationid($row->SpecializationId)
			  	  ->setName($row->Name)
			  	  ->setStatus($row->Status);
			$entries[] = $entry;
		}
		return $entries;
	}
}