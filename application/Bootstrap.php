<?php
/**
 * Application Bootstrap
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Bootstrap
 * @subpackage Zend\Application\Bootstrap\Bootstrap
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	/**
	 * Initialize default resource types for module resource classes
	 * @return void
	 */
	public function initDefaultResourceTypes(){
	
		$basePath = $this->getBasePath();
		$this->addResourceTypes(array('mappers' => array('namespace' => 'Model_Mapper','path' => 'models/mappers')));
		$this->setDefaultResourceType('model');
	}
	
	/*
	 * Inicia el autocargado de los modulos
	* @return Zend_Application_Module_Autoloader
	*/
	protected function _initAutoload(){
	
		$autoloader = new Zend_Application_Module_Autoloader(array('namespace' => '', 'basePath' => dirname(__FILE__)));
		return $autoloader;
	}
	
	/**
	 * Init error
	 * @return Exception
	 */
	protected function _initErrorHandler(){
	
		$frontController = Zend_Controller_Front::getInstance();
		$plugin = new Zend_Controller_Plugin_ErrorHandler(array('module'     => 'default',
				'controller' => 'error',
				'action'     => 'error'));
		$frontController->registerPlugin($plugin);
		return $plugin;
	}
	
	/**
	 * Inicia el timezone
	 * @return string
	 */
	protected function _initTimeZone(){
	
		date_default_timezone_set("America/Bogota");
		return date_default_timezone_get();
	}
	
	protected function _initLocale() {
		// define locale
		$locale = new Zend_Locale('es');
		// register it so that it can be used all over the website
		Zend_Registry::set('Zend_Locale', $locale);
	}
	
	/**
	 * init Zend_ACL
	 * @return void
	 */
	protected function _initACL(){
	
		$acl  = new App_Acl();
		$acl->setRoles();
		$acl->setResources();
		$acl->setPrivilages();
		$acl->setAcl();
	}
	
	protected function _initTranslate() {
		// Get Locale
		$locale = Zend_Registry::get('Zend_Locale');
	
	
		// Set up and load the translations (there are my custom translations for my app)
		$translate = new Zend_Translate(
				array(
						'adapter' => 'array',
						'content' => APPLICATION_PATH .
						'/resources/languages/' . $locale . '/Zend_Validate.php',
						'locale' => $locale)
		);
	
		// Set up ZF's translations for validation messages.
		$translate_msg = new Zend_Translate(
				array(
						'adapter' => 'array',
						'content' => APPLICATION_PATH .
						'/resources/languages/' . $locale . '/Zend_Validate.php',
						'locale' => $locale)
		);
	
		// Add translation of validation messages
		$translate->addTranslation($translate_msg);
		Zend_Form::setDefaultTranslator($translate);
	
		// Save it for later
		Zend_Registry::set('Zend_Translate', $translate);
	}
	
	/**
	 * Inicia las caracteristicas del menu en un layout
	 * @return Zend_view
	 */
	protected function _initNavigation(){
	
		$this->bootstrap('layout');
	
		$layout = $this->getResource('layout');
		$view   = $layout->getView();
		$config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
	
		$navigation = new Zend_Navigation($config);
		$view->navigation($navigation)
		->menu()
		->setMinDepth(1)
		->setUlClass('nav nav-pills')
		->setAcl(Zend_Registry::get('Zend_Acl'))
		->setRole(App_User::getProfileId());
	}
	
	/**
	 * Inicia las caracteristicas de las vista o layout
	 * @return Zend_view
	 */
	protected function _initView (){
	
		$view = new Zend_View();
		$view->setEncoding('UTF-8');
		$view->doctype('HTML5');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
		$view->headTitle('')->setSeparator(' - ');
		$view->headTitle("MS Health");
			
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setView($view);
	
		return $view;
	}
}

