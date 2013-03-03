<?php
/**
 * Patient Form Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Patient\Form\Patient
 * @subpackage Zend\Form
 */
class Patient_Form_Patient extends Twitter_Form
{
	/**
	 * formulario de add|edit de pacientes
	 *
	 * @return object|Zend\Form
	 */
    public function init()
    {
        $this->setName('frmPatient')
	    	 ->setMethod('POST')
	    	 ->addDecorator('FormElements')
	    	 ->setAttrib('vertical', true)
    		 ->removeDecorator('fieldset');
        
        $patientId  = new Zend_Form_Element_Hidden('PatientId');
        
        $identification = new Zend_Form_Element_Text('Identification');
        $identification->setLabel('Identificación')
	        		   ->setAttrib('placeholder', 'Ingrese indetificación')
	           		   ->setAttrib('escape', false)
	        		   ->setRequired(true)
	        		   ->addFilter('StringTrim')
	        		   ->addValidator('StringLength', false, array(2, 150))
	        		   ->addValidator('Db_NoRecordExists', false, array('table' => 'patient', 'field' => 'Identification'));
        
        $birthday = new Zend_Form_Element_Text('Birthday');
        $birthday->setLabel('Fecha de Cumpleaños')
				 ->setAttrib('escape', false)
				 ->setAttrib('placeholder', 'Ingrese fecha de cumpleaños')
				 ->setRequired(true)
				 ->addFilter('StringTrim')
				 ->addValidator('Date', false, array('yy-mm-dd'));
        
        $phone = new Zend_Form_Element_Text('Phone');
        $phone->setLabel('Telefono')
        	  ->setAttrib('placeholder', 'Ingrese Telefono')
        	  ->setAttrib('escape', false)        	  
        	  ->addFilter('StringTrim')
        	  ->addValidator('StringLength', false, array(4, 150));
        
        $observation = new Zend_Form_Element_Textarea('Observation');
        $observation->setLabel('Observación')
        			->setAttrib('placeholder', 'Ingrese Observación')
        			->setAttrib('escape', false)
        			->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('Aceptar');
        $this->addElements(array($patientId, $identification, $birthday, $phone, $observation, $submit));
    }
}