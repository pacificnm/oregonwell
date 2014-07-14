<?php
class Auth_RegisterController extends Auth_Model_Controller
{

    /**
     * (non-PHPdoc)
     *
     * @see Application_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    public function indexAction() 
    {
        $form = $this->getCreateForm()->account();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                    ->getPost())) {
                
                Zend_Debug::dump($this->getAllParams());
                
            }
        }
        $this->view->form = $form;
    }
    
    public function businessAction()
    {
        
    }
    
    public function paymentAction()
    {
        
    }
}