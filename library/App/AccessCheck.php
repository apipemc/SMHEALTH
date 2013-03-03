<?php
class App_AccessCheck extends Zend_Controller_Plugin_Abstract
{

	function __construct(){
		
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{		
		$moduleName 	 = $request->getModuleName();
		$controllerName  = $request->getControllerName();
		$actionName		 = $request->getActionName();
		$frontController = Zend_Controller_Front::getInstance();
		
		$Acl = Zend_Registry::get('Zend_Acl');
		
		if($Acl->isAllowed(App_User::getProfileId(), $moduleName.":".$controllerName, $actionName)){
			return;
		}			
		throw new Exception('Lo sentimos no tiene accesso a esta pagina.');
	}		
}