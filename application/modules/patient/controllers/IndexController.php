<?php
/**
 * Patient Index Controller
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Patient\Controller\IndexController
 * @subpackage Zend\Controller\Action
 */
class Patient_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function listAction()
    {
       	$this->view->headTitle('Lista de Pacientes', 'PREPEND');
    	
    	$modelSpatient  	   = new Application_Model_Patient;
    	$this->view->resultSet = $modelSpatient->fetchAll();
    }

	public function addAction()
	{
		$form = new Patient_Form_Patient;
		
		if($this->getRequest()->isPost()){
			 
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){
		
				$modelPatient = new Application_Model_Patient;
				$modelPatient->setIdentification($this->_getParam('Identification'))
							 ->setBirthday($this->_getParam('Birthday'))
							 ->setPhone($this->_getParam('Phone'))
							 ->setObservation($this->_getParam('Observation'))
						     ->save();
		
				$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha creado exitosamente'));
				$this->_helper->redirector('list', 'index', 'patient');
			}else{
				$form->populate($formData);
			}
		}	
		
		$this->view->form = $form;
		$this->_helper->viewRenderer->setScriptAction('form');
	}
	
	public function editAction()
	{
		$form 		  = new Patient_Form_Patient;
		$modelPatient = new Application_Model_Patient;
		
		if($this->getRequest()->isPost()){
			$form->Identification->addValidator('Db_NoRecordExists',
					false,
					array('table'   => 'patient',
		 				  'field'   => 'Identification',
						  'exclude' => array('field' => 'PatientId', 'value' => (int)$this->_getParam('PatientId'))));
		
			$formData = $this->getRequest()->getPost();
		
			if($form->isValid($formData)){
				 
				$modelPatient->find($this->_getParam('PatientId'))
							 ->setIdentification($this->_getParam('Identification'))
							 ->setBirthday($this->_getParam('Birthday'))
							 ->setPhone($this->_getParam('Phone'))
							 ->setObservation($this->_getParam('Observation'))
							 ->save();
				 
				$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha actualizo exitosamente'));
				$this->_helper->redirector('list', 'index', 'patient');
				 
			}else{
				$form->populate($formData);
			}
		}else{
			$id = $this->_getParam('id');
			$modelPatient->find($id);
			 
			if(is_null($modelPatient->getPatientid())){
				throw new Zend_Controller_Action_Exception("El id {$id} no encontrado",404);
			}
			 
			$form->populate($modelPatient->toArray());
		}
		
		$this->view->form = $form;
		$this->_helper->viewRenderer->setScriptAction('form');
	}
}

