<?php
/**
 * Application Model DbTable SpecializationXDoctor
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\SpecializationXDoctor
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_SpecializationXDoctor extends Zend_Db_Table_Abstract
{
    protected $_name 		 = 'specialization_x_doctor';
    protected $_primary 	 = 'SpecializationXdoctorId';
    protected $_referenceMap = array('Specialization' => array ('columns' 		=> 'SpecializationId',
											    				'refTableClass' => 'Application_Model_DbTable_Specialization',
											    				'refColumns'    => 'SpecializationId'),
									 	'Doctor'     => array ('columns' 	  	=> 'DoctorId',
															   'refTableClass'  => 'Application_Model_DbTable_Doctor',
															   'refColumns'     => 'DoctorId'));
}