<?php

class Email_Model_Email extends Application_Model_Model {

  /**
   * 
   * @var Email_Model_DbTable_Email
   */
  private $_table = null;
  
  protected $templateName;
  protected $templateVariables = array();
  protected $_viewSubject;
  protected $_viewContent;
  protected $_mail;
  protected $recipient;

  const SIGNUP_ACTIVATION = "signup-activation";
  const JOIN_CLUB_CONFIRMATION = "join-club-confirmation";
  const SUPPORT_TICKET = 'support-ticket';
  const EMPLOYEE_SUPPORT_TICKET = 'employee_support_ticket';
  
  /**
   * Set variables for use in the templates
   *
   * @param string $name  The name of the variable to be stored
   * @param mixed  $value The value of the variable
   */
  public function setVar($name, $value) {
    $this->templateVariables[$name] = $value;
  }

  /**
   * Set the template file to use
   *
   * @param string $filename Template filename
   */
  public function setTemplate($filename) {
    $this->templateName = $filename;
  }

  /**
   * Set the recipient address for the email message
   * 
   * @param string $email Email address
   */
  public function setRecipient($email) {
    $this->recipient = $email;
  }

  /**
   * Send email
   *
   * @todo Add from name
   */
  public function send() {
    $config = Zend_Registry::get('Application_Config');
        
    $emailPath = APPLICATION_PATH . $config->mail->templatePath;
    $templateVars = $config->mail->template->toArray();

    $this->_mail = new Zend_Mail();
    $this->_viewSubject = new Zend_View();
    $this->_viewContent = new Zend_View();

    foreach ($templateVars as $key => $value) {
      if (!array_key_exists($key, $this->templateVariables)) {
        $this->{$key} = $value;
      }
    }

    $viewSubject = $this->_viewSubject->setScriptPath($emailPath);
    foreach ($this->templateVariables as $key => $value) {
      $viewSubject->{$key} = $value;
    }
    $subject = $viewSubject->render($this->templateName . '.subj');

    $viewContent = $this->_viewContent->setScriptPath($emailPath);
    foreach ($this->templateVariables as $key => $value) {
      $viewContent->{$key} = $value;
    }
    $html = $viewContent->render($this->templateName . '.tpl');

    $this->_mail->addTo($this->recipient);
    $this->_mail->setSubject($subject);
    $this->_mail->setBodyHtml($html);
    $this->_mail->setFrom($config->mail->defaultFrom->email,$config->mail->defaultFrom->name);
    
    $transConfig = array(
      'auth'     => $config->mail->transport->auth,
      'username' => $config->mail->transport->username,
      'password' => $config->mail->transport->password
    );
    
    $transport = new Zend_Mail_Transport_Smtp($config->mail->transport->host, $transConfig);

    $this->_mail->send($transport);
   
  }

  /**
   * 
   * @param int $employeeId
   * @param int $clientId
   * @param int $emailDate
   * @param string $emailTo
   * @param string $emailSubject
   * @param string $emailBody
   * @param int $emailId
   * @return int
   */
  public function save($employeeId, $clientId, $emailDate, $emailTo, $emailSubject, $emailBody, $emailId = NULL) {
    $data = array(
      'employee_id' => $employeeId,
      'client_id' => $clientId,
      'email_date' => $emailDate,
      'email_to' => $emailTo,
      'email_subject' => $emailSubject,
      'email_body' => $emailBody
    );

    if ($emailId == null) {
      $emailId = $this->create($data);
    }
    else {
      $this->update($emailId, $data);
    }

    return $emailId;
  }

  /**
   * 
   * @param array $data
   * @return int
   * @throws Zend_Exception
   */
  public function create($data) {
    try {
      $emailId = $this->getTable()->insert($data);
      return $emailId;
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }

  /**
   * 
   * @param int $emailId
   * @param array $data
   * @return int
   * @throws Zend_Exception
   */
  public function update($emailId, $data) {
    try {
      $where = $this->getTable()
          ->getDefaultAdapter()
          ->quoteInto('email_id = ?', $emailId);

      $this->getTable()->update($data, $where);
      return $emailId;
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }

  /**
   * 
   * @param int $emailId
   * @return int
   * @throws Zend_Exception
   */
  public function delete($emailId) {
    try {
      $where = $this->getTable()
          ->getDefaultAdapter()
          ->quoteInto('email_id', $emailId);

      $this->getTable()->delete($where);
      return $emailId;
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }

  /**
   * 
   * Returns the database table object
   *
   * @return Email_Model_DbTable_Email
   */
  protected function getTable() {
    if (null !== $this->_table) {
      return $this->_table;
    }
    else {
      $this->_table = new Email_Model_DbTable_Email();
      return $this->_table;
    }
  }

}
