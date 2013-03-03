<?php
/**
 * Application Model DbTable Profile
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Application\Model\DbTable\Profile
 * @subpackage Zend\Db\Table\Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Profile extends Zend_Db_Table_Abstract
{
    protected $_name 		 = 'profile';
    protected $_primary 	 = 'ProfileId';
    protected $_referenceMap = array('User' => array ('columns' 	  => 'ProfileId',
											    	  'refTableClass' => 'Application_Model_DbTable_User',
											    	  'refColumns'    => 'ProfileId'));
}
