<?php
/**
 * Application Model DbTable Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\Patient
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Patient extends Zend_Db_Table_Abstract
{
    protected $_name 		 = 'patient';
    protected $_primary 	 = 'PatientId';    
    protected $_referenceMap = array('Booking' => array ('columns' 	  	 => 'PatientId',
												    	 'refTableClass' => 'Application_Model_DbTable_Booking',
												    	 'refColumns'    => 'PatientId'));
}