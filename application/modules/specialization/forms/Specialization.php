<?php
/**
 * Specialization Form Specialization
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Specialization\Form\Specialization
 * @subpackage Zend\Form
 */
class Specialization_Form_Specialization extends Twitter_Form
{
	/**
	 * formulario de add|edit de especializaciones
	 *
	 * @return object|Zend\Form
	 */
    public function init()
    {
        $this->setName('frmSpecialization')
	    	 ->setMethod('POST')
	    	 ->addDecorator('FormElements')
	    	 ->setAttrib('vertical', true)
    		 ->removeDecorator('fieldset');
        
        $specializationId  = new Zend_Form_Element_Hidden('SpecializationId');
        
        $name = new Zend_Form_Element_Text('Name');
        $name->setLabel('Nombre')
	         ->setAttrib('placeholder', 'Ingrese nombre')
	         ->setAttrib('escape', false)
	         ->setRequired(true)
	         ->addFilter('StringTrim')
	         ->addValidator('StringLength', false, array(4, 150))
	         ->addValidator('Db_NoRecordExists', false, array('table' => 'specialization', 'field' => 'Name'));
        
        $status = new Zend_Form_Element_Select('Status');
        $status->setLabel('Estado: ')
        	   ->setAttrib('escape', false)
        	   ->setRequired(true)
        	   ->addFilter('StringTrim')
               ->addMultiOption('1', 'Activo')
               ->addMultiOption('0', 'Inactivo');
        
        $submit = new Zend_Form_Element_Submit('Aceptar');
        $this->addElements(array($specializationId, $name, $status, $submit));
    }
}