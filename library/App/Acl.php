<?php
class App_Acl
{

    public $acl;

    public function __construct(){        

        $this->acl = new Zend_Acl();
    }

    public function setRoles(){        

    	$roleGuest 		= new Zend_Acl_Role('1');
    	$roleCallCenter	= new Zend_Acl_Role('2');
    	$roleSuperUser	= new Zend_Acl_Role('3');
    	
        $this->acl->addRole($roleGuest);
        $this->acl->addRole($roleCallCenter,$roleGuest);
        $this->acl->addRole($roleSuperUser,$roleCallCenter,$roleGuest);
    }

    public function setResources(){        

    	$this->acl->add(new Zend_Acl_Resource('default:index'));
        $this->acl->add(new Zend_Acl_Resource('default:error'));
        $this->acl->add(new Zend_Acl_Resource('booking:index'));
        $this->acl->add(new Zend_Acl_Resource('patient:index'));
        $this->acl->add(new Zend_Acl_Resource('doctor:index'));        
        $this->acl->add(new Zend_Acl_Resource('specialization:index'));
    }		

    public function setPrivilages(){        

        $this->acl->allow('1', 
						  array('default:index','default:error'), 
						  array('index','logout','error'));
        
        $this->acl->allow('2',
			              array('booking:index','patient:index'),
			        	  array('list','add','edit'));
        
        $this->acl->allow('3',
			        	  array('doctor:index', 'specialization:index'),
                          array('list','add','edit'));        
        
    }

    public function setAcl(){        

        Zend_Registry::set('Zend_Acl', $this->acl);
    }
}