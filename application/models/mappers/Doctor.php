<?php
/**
 * Application Model Mapper Doctor
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\Mappers\Doctor
 */
class Application_Model_Mapper_Doctor
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
			$this->setDbTable('Application_Model_DbTable_Doctor');
		}
		return $this->_dbtable;
	}
	
	public function save(Application_Model_Doctor $model){
	
		$data = array('Name'		  => $model->getName(),
					  'Identification'=> $model->getIdentification(),
					  'Birthday'      => $model->getBirthday(),
					  'StarTime'      => $model->getStartime(),
					  'EndTime'       => $model->getEndtime(),
					  'Status'   	  => $model->getStatus());
	
		if (null === ($id = $model->getDoctorid())){
			unset($data['DoctorId']);
			return $this->getDbTable()->insert($data);
		}else{
			return $this->getDbTable()->update($data, array('DoctorId = ?' => $id));
		}
	}
	
	public function find($id, Application_Model_Doctor $model){
	
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return;
		}
	
		$row = $result->current();
		$model->setDoctorid($row->DoctorId)
			  ->setName($row->Name)
			  ->setIdentification($row->Identification)
			  ->setBirthday($row->Birthday)
			  ->setStartime($row->StarTime)
			  ->setEndtime($row->EndTime)
			  ->setStatus($row->Status);
	}
	
	public function fetchAll($where, $order, $count, $offset){
	
		$resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
		$entries   = array();
		foreach ($resultSet as $row){
	
			$entry = new Application_Model_Doctor;
			$entry->setDoctorid($row->DoctorId)
				  ->setName($row->Name)
				  ->setIdentification($row->Identification)
				  ->setBirthday($row->Birthday)
				  ->setStartime($row->StarTime)
				  ->setEndtime($row->EndTime)
				  ->setStatus($row->Status);
			$entries[] = $entry;
		}
		return $entries;
	}
}