<?php
/* Default Index Controller
*
* @author     Andres Felipe Martinez Codero
* @package    Default\Controller\IndexController
* @subpackage Zend\Controller\Action
*/
class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {    	
    	if(App_User::isLogged()){
    		$this->_helper->redirector('list', 'index', 'booking');
    	}
    	
    	$form = new Default_Form_Login;
    	$form->addElement(new Zend_Form_Element_Hash('csrf'));
    	$csrf = $form->getElement('csrf');
    	$csrf->initCsrfToken();
    	$csrf->initCsrfValidator();
    	
    	if($this->getRequest()->isPost()){
    			
    		$formData 		  = $this->getRequest()->getPost();
    		$formData['csrf'] = $csrf->getHash();
    		if($form->isValid($formData)){
    			$modelSecurity = new Application_Model_Security;
    			$username      = $this->_getParam('Username');
    			$password      = $this->_getParam('Password');
    			
    			if($modelSecurity->ValidUser($username,$password)){
    				$this->_helper->redirector('list', 'index', 'booking');
    			}else{
    				$form->Password->addError('Usuario o contraseña no válidas. Por favor, inténtelo de nuevo.');
    				$form->populate($formData);
    			}
    		}else{
                $form->populate($formData); 
			}	
    	}
    	$this->view->form = $form;
    }
    
    public function logoutAction(){
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_helper->redirector('index', 'index', 'default');
    }
}