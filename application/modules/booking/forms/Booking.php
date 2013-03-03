<?php
/**
 * Booking Form Patient
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Booking\Form\Patient
 * @subpackage Zend\Form
 */
class Booking_Form_Booking extends Twitter_Form
{
	/**
	 * formulario de add|edit de booking
	 *
	 * @return object|Zend\Form
	 */
    public function init()
    {
    	$this->setName('frmBooking')
	    	 ->setMethod('POST')
	    	 ->addDecorator('FormElements')
	    	 ->setAttrib('vertical', true)
	    	 ->removeDecorator('fieldset');
    	
    	$bookingId = new Zend_Form_Element_Hidden('BookingId');
    	
    	$date = new Zend_Form_Element_Text('date');
    	$date->setLabel('Fecha Cita')
		     ->setAttrib('escape', false)
		     ->setAttrib('placeholder', 'Ingrese Fecha Cita')
		     ->setRequired(true)
		     ->addFilter('StringTrim')
		     ->addValidator('Date', false, array('yy-mm-dd'));
    	
    	$time = new Zend_Form_Element_Text('time');
    	$time->setLabel('Hora Cita')
		     ->setAttrib('placeholder', 'Ingrese Hora cita')
		     ->setAttrib('escape', false)
		     ->setRequired(true)
		     ->addFilter('StringTrim');
    	
    	$modelDoctor = new Application_Model_Doctor;
    	$resultSet   = $modelDoctor->fetchAll(array('Status = ?' => 1));
    	
    	$doctor = new Zend_Form_Element_Select('DoctorId');
    	$doctor->setLabel('Doctor ')
	    	   ->setAttrib('escape', false)
	    	   ->setRequired(true)
	    	   ->addFilter('StringTrim');
    	 
    	foreach ($resultSet as $key => $value){
    		$doctor->addMultiOption($value->getDoctorid(), $value->getName());
    	}
    	
    	unset($resultSet);
    	$modelPatient = new Application_Model_Patient;
    	$resultSet    = $modelPatient->fetchAll();
    	 
    	$patient = new Zend_Form_Element_Select('PatientId');
    	$patient->setLabel('Paciente ')
		    	->setAttrib('escape', false)
		    	->setRequired(true)
		    	->addFilter('StringTrim');
    	
    	foreach ($resultSet as $key => $value){
    		$patient->addMultiOption($value->getPatientid(), $value->getIdentification());
    	}
    	
    	$status = new Zend_Form_Element_Select('Status');
    	$status->setLabel('Estado: ')
		       ->setAttrib('escape', false)
		       ->setRequired(true)
		       ->addFilter('StringTrim')
		       ->addMultiOption('1', 'Activo')
		       ->addMultiOption('0', 'Inactivo');
    	
    	$submit = new Zend_Form_Element_Submit('Aceptar');
    	$this->addElements(array($bookingId, $date, $time, $doctor, $patient, $status, $submit));
    }
}