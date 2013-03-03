<?php
/**
 * Application Model DbTable Doctor
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\Doctor
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Doctor extends Zend_Db_Table_Abstract
{
    protected $_name 		= 'doctor';
    protected $_primary 	= 'DoctorId';
    protected $_dependentTables = array('Application_Model_DbTable_SpecializationXDoctor');
    protected $_referenceMap 	= array('Booking' => array ('columns' 	  	=> 'DoctorId',
												    		'refTableClass' => 'Application_Model_DbTable_Booking',
												    		'refColumns'    => 'DoctorId'));


}