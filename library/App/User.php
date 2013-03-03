<?php
class App_User{	
    
	private static $_loggedUser = null;
	
	public function __construct(){
		throw new Exception("La clase App_User no debe ser instanciada. Utilice sus metodos de manera estatica.");
	}
	
	private static function inicializar(){
        if (null === self::$_loggedUser){
        	self::$_loggedUser = new Zend_Session_Namespace("loggedUser");
        }
    }
    
	public static function isLogged(){
    	return Zend_Auth::getInstance()->hasIdentity();
	}

	public static function getUserId(){		
    	if (Zend_Auth::getInstance()->hasIdentity()){
    		return Zend_Auth::getInstance()->getIdentity()->UserId;
    	}
        return null;
    }
    
    public static function getUsername(){
    	if (Zend_Auth::getInstance()->hasIdentity()){
    		return Zend_Auth::getInstance()->getIdentity()->Username;
    	}
    	return null;
    }

    public static function getProfileId(){
        if (Zend_Auth::getInstance()->hasIdentity()){
            return Zend_Auth::getInstance()->getIdentity()->ProfileId;
        }
        return '1';
    }
}