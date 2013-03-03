<?php
/**
 * Default Module Security
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Default\Model\Security
 */
class Application_Model_Security
{
	public function ValidUser($username, $pass){
	
		$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
		$authAdapter->setTableName('user')
					->setIdentityColumn('Username')
					->setCredentialColumn('Password')
					->setIdentity($username)
					->setCredential(sha1($pass));
	
		$select = $authAdapter->getDbSelect();
		$select->where("Status = ?", (int)1);
	
		$auth   = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);
		if($result->isValid())
		{
			$userInfo = $authAdapter->getResultRowObject(array("UserId", "Username", "ProfileId"));
			$auth->getStorage()->write($userInfo);
			return true;
		}
		return false;
	}

}