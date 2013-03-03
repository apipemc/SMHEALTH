<?php
/**
 * Doctor Index Controller
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Doctor\Controller\IndexController
 * @subpackage Zend\Controller\Action
 */
class Doctor_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function listAction()
    {
        $this->view->headTitle('Lista de Doctores', 'PREPEND');
    	
    	$modelDoctor           = new Application_Model_Doctor;
    	$this->view->resultSet = $modelDoctor->fetchAll();
    }
    
    public function addAction()
    {
    	$form = new Doctor_Form_Doctor;
    	
    	if($this->getRequest()->isPost()){
    		 
    		$formData = $this->getRequest()->getPost();
    		if($form->isValid($formData)){
    	
    			$modelDoctor = new Application_Model_Doctor;
    			$doctorId    = $modelDoctor->setName($this->_getParam('Name'))
										->setIdentification($this->_getParam('Identification'))
										->setBirthday($this->_getParam('Birthday'))
										->setStartime($this->_getParam('StarTime'))
										->setEndtime($this->_getParam('EndTime'))
										->setStatus($this->_getParam('Status'))
								    	->save();    	
    			foreach ($this->_getParam('specialization') as $value)
    			{
    				$modelSpecializationxdoctor = new Application_Model_SpecializationXDoctor;
    				$modelSpecializationxdoctor->setSpecializationid($value)
    										   ->setDoctorid($doctorId)
    										   ->save();
    			}
    			
    			$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha creado exitosamente'));
    			$this->_helper->redirector('list', 'index', 'doctor');
    		}else{
    			$form->populate($formData);
    		}
    	}
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
    
    public function editAction()
    {
    	$form 		 = new Doctor_Form_Doctor;
    	$modelDoctor = new Application_Model_Doctor;
    	
    	if($this->getRequest()->isPost()){
    		$form->Name->addValidator('Db_NoRecordExists',
					    				false,
					    				array('table'   => 'doctor',
   				    						  'field'   => 'Name',
					    					  'exclude' => array('field' => 'DoctorId', 'value' => (int)$this->_getParam('DoctorId'))));
    	
    		$form->Identification->addValidator('Db_NoRecordExists',
						    				false,
						    				array('table'   => 'doctor',
						    					  'field'   => 'Identification',
						    					  'exclude' => array('field' => 'DoctorId', 'value' => (int)$this->_getParam('DoctorId'))));
    		
    		$formData = $this->getRequest()->getPost();
    	
    		if($form->isValid($formData)){
    			 
    			$modelDoctor->find($this->_getParam('DoctorId'))
    						->setName($this->_getParam('Name'))
							->setIdentification($this->_getParam('Identification'))
							->setBirthday($this->_getParam('Birthday'))
							->setStartime($this->_getParam('StarTime'))
							->setEndtime($this->_getParam('EndTime'))
							->setStatus($this->_getParam('Status'))
					    	->save();    			

    			$modelSpecializationxdoctor = new Application_Model_SpecializationXDoctor;
    			foreach ($modelSpecializationxdoctor->fetchAll(array('DoctorId = ?' => $this->_getParam('DoctorId'))) as $value)
    			{
    				$modelSpecializationxdoctor->delete($value->getSpecializationxdoctorid());
    			}	
    			
    			
    			foreach ($this->_getParam('specialization') as $value)
    			{
    				$modelSpecializationxdoctor = new Application_Model_SpecializationXDoctor;
    				$modelSpecializationxdoctor->setSpecializationid($value)
    				->setDoctorid($this->_getParam('DoctorId'))
    				->save();
    			}
    			 
    			$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha actualizo exitosamente'));
    			$this->_helper->redirector('list', 'index', 'doctor');
    			 
    		}else{
    			$form->populate($formData);
    		}
    	}else{
    		$id = $this->_getParam('id');
    		$modelDoctor->find($id);
    		 
    		if(is_null($modelDoctor->getDoctorid())){
    			throw new Zend_Controller_Action_Exception("El id {$id} no encontrado",404);
    		}
    		
    		$tmp = $modelDoctor->toArray();
    		$tmp['specialization'] = array();
    		$modelSpecializationxdoctor = new Application_Model_SpecializationXDoctor;
    		foreach ($modelSpecializationxdoctor->fetchAll(array('DoctorId = ?' => $tmp['DoctorId'])) as $value)
    		{
    			$tmp['specialization'][] = $value->getSpecializationid();
    		}	
    		
    		$form->populate($tmp);
    	}
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
}