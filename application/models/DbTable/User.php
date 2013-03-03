<?php
/**
 * Application Model DbTable User
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\User
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name 			= 'user';
    protected $_primary 	 	= 'UserId';
    protected $_dependentTables = array('Application_Model_DbTable_Profile');
    protected $_referenceMap 	= array('Booking' => array ('columns' 	  	=> 'UserId',
												    		'refTableClass' => 'Application_Model_DbTable_Booking',
												    		'refColumns'    => 'UserId'));
}