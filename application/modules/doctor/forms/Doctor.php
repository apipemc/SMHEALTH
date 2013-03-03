<?php
/**
 * Doctor Form Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Doctor\Form\Patient
 * @subpackage Zend\Form
 */
class Doctor_Form_Doctor extends Twitter_Form
{
	/**
	 * formulario de add|edit de doctores
	 *
	 * @return object|Zend\Form
	 */
    public function init()
    {
        $this->setName('frmDoctor')
	    	 ->setMethod('POST')
	    	 ->addDecorator('FormElements')
	    	 ->setAttrib('vertical', true)
    		 ->removeDecorator('fieldset');
        
        $doctorId  = new Zend_Form_Element_Hidden('DoctorId');
        
        $name = new Zend_Form_Element_Text('Name');
        $name->setLabel('Nombre')
		     ->setAttrib('placeholder', 'Ingrese nombre')
		     ->setAttrib('escape', false)
		     ->setRequired(true)
		     ->addFilter('StringTrim')
		     ->addValidator('StringLength', false, array(4, 150))
		     ->addValidator('Db_NoRecordExists', false, array('table' => 'doctor', 'field' => 'Name'));
        
        $identification = new Zend_Form_Element_Text('Identification');
        $identification->setLabel('Identificación')
	        		   ->setAttrib('placeholder', 'Ingrese indetificación')
	           		   ->setAttrib('escape', false)
	        		   ->setRequired(true)
	        		   ->addFilter('StringTrim')
	        		   ->addValidator('StringLength', false, array(2, 150))
	        		   ->addValidator('Db_NoRecordExists', false, array('table' => 'doctor', 'field' => 'Identification'));
        
        $birthday = new Zend_Form_Element_Text('Birthday');
        $birthday->setLabel('Fecha de Cumpleaños')
				 ->setAttrib('escape', false)
				 ->setAttrib('placeholder', 'Ingrese fecha de cumpleaños')
				 ->setRequired(true)
				 ->addFilter('StringTrim')
				 ->addValidator('Date', false, array('yy-mm-dd'));
        
        $startime = new Zend_Form_Element_Text('StarTime');
        $startime->setLabel('Horario Inicio')
		         ->setAttrib('placeholder', 'Ingrese horario inicio')
		         ->setAttrib('escape', false)
		         ->setRequired(true)
		         ->addFilter('StringTrim');
        
        $endtime = new Zend_Form_Element_Text('EndTime');
        $endtime->setLabel('Horario Fin')
		        ->setAttrib('placeholder', 'Ingrese horario fin')
		        ->setAttrib('escape', false)
		        ->setRequired(true)
		        ->addFilter('StringTrim');
        
        $modelSpecialization = new Application_Model_Specialization;
        $resultSet   = $modelSpecialization->fetchAll(array('Status = ?' => 1));
        
        $multi = new Zend_Form_Element_Multiselect('specialization');        
        $multi->setRequired(true);   
        
        foreach ($resultSet as $key => $value){
        	$multi->addMultiOption($value->getSpecializationid(), $value->getName());
        }
        
        $status = new Zend_Form_Element_Select('Status');
        $status->setLabel('Estado: ')
        	   ->setAttrib('escape', false)
        	   ->setRequired(true)
        	   ->addFilter('StringTrim')
               ->addMultiOption('1', 'Activo')
               ->addMultiOption('0', 'Inactivo');
        
        $submit = new Zend_Form_Element_Submit('Aceptar');
        $this->addElements(array($doctorId, $name, $identification, $birthday, $startime, $endtime, $multi, $status, $submit));
    }
}