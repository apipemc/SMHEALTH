<?php
/**
 * Application Model DbTable Specialization
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\Specialization
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Specialization extends Zend_Db_Table_Abstract
{

    protected $_name 		 	= 'specialization';
    protected $_primary 	 	= 'SpecializationId';    
    protected $_dependentTables = array('Application_Model_DbTable_SpecializationXDoctor');
}

