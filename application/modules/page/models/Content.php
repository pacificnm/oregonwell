<?php

class Page_Model_Content extends Application_Model_Model 
{


  private $_table = null;

  
  public function findByName($contentName)
  {
    $cacheId = md5('Page_Model_Content::findByName_' . $contentName);
    
    $select = $this->getSelect()
        ->where('content_name = ?', $contentName)
        ->where('content_active = ?', 1);
    
    return $this->getRow($select, NULL, $this->getTable());
  }
  
  public function findById($contentId)
  {
    $select = $this->getSelect()
        ->where('content_id = ?', $contentId);
    
    return $this->getRow($select, NULL, $this->getTable());
  }
  
  
  public function findAll($contentName = NULL, $contentType = NULL, $contentActive = 1)
  {
    $select = $this->getSelect();
    
    if($contentName) {
      $select->where('content_name = ?', $contentName);
    }
    
    if($contentType) {
      $select->where('content_type = ?', $contentType);
    }
        
    $select->where('content_active = ?', $contentActive)->order('content_title');
    
    return $this->getRowSet($select, NULL, $this->getTable());
  }
  
  
  public function save($contentType, $contentName, $contentBody,
      $contentDescription, $contentKeyword, $contentTitle, $contentActive, 
      $contentHits, $contentCreated, $contentId = NULL)
  {
    $data = array(
      'content_type' => $contentType,
      'content_name' => $contentName,
      'content_body' => $contentBody,
      'content_description' => $contentDescription,
      'content_keyword' => $contentKeyword,
      'content_title' => $contentTitle,
      'content_active' => $contentActive,
      'content_hits' => $contentHits,
      'content_created' => $contentCreated
    );
    
    if ($contentId == null) {
      $contentId = $this->create($data);
    }
    else {
      $this->update($contentId, $data);
    }

    return $contentId;
  }
  
  
  public function create($data)
  {
    try {

      $contentId = $this->getTable()->insert($data);

      return $contentId;
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }
  
  public function closeContent($contentId)
  {
    $data = array('content_active' => 0);
    
    $this->update($contentId, $data);
  }
  
  public function addHit($contentId)
  {
    $content = $this->findById($contentId);
    
    $contentHit = $content->content_hits + 1;
    
    $data = array('content_hits' => $contentHit);
    
    $this->update($contentId, $data);
  }
  
  public function update($contentId, $data)
  {
    
    $where = $this->getTable()->getDefaultAdapter()->quoteInto('content_id = ?', $contentId);
     
    $this->getTable()->update($data, $where);
  }
  
  public function slugify($text)
  {
      // Swap out Non "Letters" with a -
      $text = preg_replace('/[^\\pL\d]+/u', '-', $text); 

      // Trim out extra -'s
      $text = trim($text, '-');

      // Convert letters that we have left to the closest ASCII representation
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // Make text lowercase
      $text = strtolower($text);

      // Strip out anything we haven't been able to convert
      $text = preg_replace('/[^-\w]+/', '', $text);

      return $text;
  }
  
  
  /**
   * Returns the database table object
   *
   * @return Page_Model_DbTable_Page
   */
  protected function getTable() {
    if (null !== $this->_table) {
      return $this->_table;
    }
    else {
      $this->_table = new Page_Model_DbTable_Content();
      return $this->_table;
    }
  }
  
  }
  