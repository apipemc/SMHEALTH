<?php
/**
 * Specialization Index Controller
 *
 * @author     Andres Felipe Martinez Codero
 * @package    Specialization\Controller\IndexController
 * @subpackage Zend\Controller\Action
 */
class Specialization_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function listAction()
    {
    	$this->view->headTitle('Lista de Especialistas', 'PREPEND');
    	
    	$modelSpeacialization  = new Application_Model_Specialization;
    	$this->view->resultSet = $modelSpeacialization->fetchAll();
    }

    public function addAction()
    {
    	$form = new Specialization_Form_Specialization;
    	
    	if($this->getRequest()->isPost()){
    	
    		$formData = $this->getRequest()->getPost();
    		if($form->isValid($formData)){
    			 
    			$modelSpeacialization = new Application_Model_Specialization;
    			$modelSpeacialization->setName($this->_getParam('Name'))
    								 ->setStatus($this->_getParam('Status'))
    								 ->save();
    			 
    			$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha creado exitosamente'));
    			$this->_helper->redirector('list', 'index', 'specialization');    			
    		}else{
    			$form->populate($formData);
    		}
    	}
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
    
    public function editAction()
    {
    	$form 				  = new Specialization_Form_Specialization;
    	$modelSpeacialization = new Application_Model_Specialization;
    	
    	if($this->getRequest()->isPost()){
    		$form->Name->addValidator('Db_NoRecordExists',
    				false,
    				array('table'   => 'specialization',
    					  'field'   => 'Name',
    					  'exclude' => array('field' => 'SpecializationId', 'value' => (int)$this->_getParam('SpecializationId'))));
    		
    		$formData = $this->getRequest()->getPost();
    		
    		if($form->isValid($formData)){
    	
    			$modelSpeacialization->find($this->_getParam('SpecializationId'))
    								 ->setName($this->_getParam('Name'))
    								 ->setStatus($this->_getParam('Status'))
    								 ->save();
    	
    			$this->_helper->flashMessenger->addMessage(array('info'=>'Se ha actualizo exitosamente'));
    			$this->_helper->redirector('list', 'index', 'specialization');
    	
    		}else{
    			$form->populate($formData);
    		}
    	}else{
    		$id = $this->_getParam('id');
    		$modelSpeacialization->find($id);
    			
    		if(is_null($modelSpeacialization->getSpecializationid())){
    			throw new Zend_Controller_Action_Exception("El id {$id} no encontrado",404);
    		}
    			
    		$form->populate($modelSpeacialization->toArray());
    	}    	
    	
    	$this->view->form = $form;
    	$this->_helper->viewRenderer->setScriptAction('form');
    }
}