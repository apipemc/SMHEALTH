<?php
/**
 * Booking Index Controller
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Booking\Controller\IndexController
 * @subpackage Zend\Controller\Action
 */
class Booking_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function listAction()
    {
    	$this->view->headTitle('Lista de Reservas', 'PREPEND');
    	
        $modelBooking = new Application_Model_Booking;
    	
    	$resultSet = array();
    	foreach ($modelBooking->getMapper()->getDbTable()->fetchAll() AS $key => $value){
    			
    		$doctor   = $value->findDependentRowset('Application_Model_DbTable_Doctor');    		
    		$patient  = $value->findDependentRowset('Application_Model_DbTable_Patient');
    		$suer     = $value->findDependentRowset('Application_Model_DbTable_User');
    			
    		$temp = array('Date' 	   => substr($value['Reservationdate'],0,10),
    					  'Time' 	   => substr($value['Reservationdate'],10),
	    				  'Doctor' 	   => $doctor[0]['Name'],
	    				  'Patient'    => $patient[0]['Identification'],
    					  'Status'     => $value['Status'],
    					  'BookingId'  => $value['BookingId']);
    		
			$resultSet[] = (object)$temp;
    		unset($temp);
    	}
    	 
    	$this->view->resultSet = $resultSet;
    }

    public function addAction()
    {
    	$form = new Booking_Form_Booking;
    	
    	if($this->getRequest()->isPost()){
    		 
    		$formData = $this->getRequest()->getPost();
    		if($form->isValid($formData)){
    			 
    			$modelDoctor = new Application_Model_Doctor;
    			$modelDoctor->find($this->_getParam('DoctorId'));
    			
    			if(strtotime($modelDoctor->getStartime()) < strtotime($this->_getParam('time')) && strtotime($modelDoctor->getEndtime()) > strtotime($this->_getParam('time'))){
    				
    				$modelBooking = new  Application_Model_Booking;
    				$resultSet    = $modelBooking->fetchAll(array('DoctorId = ?' => $this->_getParam('DoctorId'), 'Reservationdate = ?' => $this->_getParam('date').' '.$this->_getParam('time')));
    				if(count($resultSet) == 0){
    					$modelBooking = new Application_Model_Booking;
    					$modelBooking->setReservationdate($this->_getParam('date').' '.$this->_getParam('time'))
			    					 ->setDoctorid($this->_getParam('DoctorId'))
			    					 ->setPatientid($this->_getParam('PatientId'))
			    					 ->setUserId(App_User::getUserId())
			    					 ->setStatus($this->_getParam('Status'))
			    					 ->save();
    					
    					$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha creado exitosamente'));
    					$this->_helper->redirector('list', 'index', 'booking');
    				}else{
    					$form->time->addError('El doctor se encuentra ocupado en la hora '.$this->_getParam('time'));
    					$form->populate($formData);
    				}
    			}else{
    				$form->time->addError('El doctor no esta horarios dispbiles para las '.$this->_getParam('time'));
    				$form->populate($formData);
    			}
    		}else{
    			$form->populate($formData);
    		}
    	}
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
    

    public function editAction()
    {
    	$form 		  = new Booking_Form_Booking;
    	$modelBooking = new Application_Model_Booking;
    	
    	if($this->getRequest()->isPost()){
    		$formData = $this->getRequest()->getPost();
    		 
    		if($form->isValid($formData)){
    	
    			$modelBooking->find($this->_getParam('BookingId'))
    						 ->setReservationdate($this->_getParam('date').' '.$this->_getParam('time'))    						 
			    			 ->setDoctorid($this->_getParam('DoctorId'))
			    			 ->setPatientid($this->_getParam('PatientId'))
			    			 ->setUserId(App_User::getUserId())			    			 
			    			 ->setStatus($this->_getParam('Status'))
			    			 ->save();    			 
    	
    			$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha actualizo exitosamente'));
    			$this->_helper->redirector('list', 'index', 'booking');
    	
    		}else{
    			$form->populate($formData);
    		}
    	}else{
    		$id = $this->_getParam('id');
    		$modelBooking->find($id);
    		 
    		if(is_null($modelBooking->getBookingid())){
    			throw new Zend_Controller_Action_Exception("El id {$id} no encontrado",404);
    		}
    		 
    		$temp = $modelBooking->toArray();
    		$temp['date'] = substr($temp['Reservationdate'],0,10);    					   	   
    		$temp['time'] = substr($temp['Reservationdate'],10);
    		
    		$form->populate($temp);
    	}
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
}

