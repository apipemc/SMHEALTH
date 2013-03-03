<?php
/**
 * Application Model DbTable Booking
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\Booking
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Booking extends Zend_Db_Table_Abstract
{

    protected $_name 		 = 'booking';
    protected $_primary 	 = 'BookingId';
    protected $_referenceMap = array('Doctor'  => array ('columns' 	  	 => 'DoctorId',
										      			 'refTableClass' => 'Application_Model_DbTable_Doctor',
										    			 'refColumns'    => 'DoctorId'),
    								'Patient'  => array ('columns' 		 => 'PatientId',
													     'refTableClass' => 'Application_Model_DbTable_Patient',
													     'refColumns'    => 'PatientId'),
    								'User' 	   => array ('columns' 		 => 'UserId',
													     'refTableClass' => 'Application_Model_DbTable_User',
													     'refColumns'    => 'UserId'));


}

