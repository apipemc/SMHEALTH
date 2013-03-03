<?php
/**
 * Default Form Login
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Default\Form\login
 * @subpackage Zend\Form
 */
class Default_Form_Login extends Twitter_Form
{
	/**
	 * formulario de logeo de usuarios a la aplicacion
	 *
	 * @return object|Zend\Form
	 */
    public function init()
    {
    	$this->setName('frmLogin')
    		 ->setMethod('post')
    		 ->setAttrib('class', 'form-signin')
    		 ->setAttrib('vertical', true)
    		 ->removeDecorator('fieldset');
    	
    	$username = new Zend_Form_Element_Text('Username');
    	$username->setRequired(true)
    			 ->addFilter('StringTrim')
    		     ->setAttrib('class' ,'input-block-level')
    			 ->setAttrib('placeholder' ,'Usuario')
    			 ->addValidator('NotEmpty', true);
    	
    	$password = new Zend_Form_Element_Password('Password');
    	$password->setRequired(true)
    			 ->setAttrib('class' ,'input-block-level')
    			 ->setAttrib('placeholder' ,'Contraseña')
    			 ->addFilter('StringTrim')
    			 ->addValidator('NotEmpty', true);
    		
    	$submit = new Zend_Form_Element_Submit('Login');
    	$submit->setAttrib('class', 'btn-large')
    		   ->removeDecorator('div');
    	
    	$this->addElements(array($username, $password, $submit));
    }
}