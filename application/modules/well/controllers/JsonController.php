<?php
//error_reporting( 0 );
class Well_JsonController extends Well_Model_Controller_Well
{

    public function init ()
    {
        parent::init();
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        
    }
    
    public function browseAction()
    {
        $search = array();
        //$page = $this->getPage();
        
     
        $iDisplayStart = (int) $this->_getParam('iDisplayStart', 0);
        $iDisplayLength = (int) $this->_getParam('iDisplayLength', 10);
        
        // County Fileter
        $counties =  $this->getParam('filterCounty', 0);
        $search['filterCounty'] = $counties;
        
        // type filter
        $type = $this->getParam('filterType', 0);
        $search['filterType'] = $type;
        
        // use filter
        $use = $this->getParam('filterUse', 0);
        $search['filterUse'] = $use;
        
        // textSearch
        $filterText = $this->getParam('filterText', 0);
        $search['filterText'] = $filterText;
        
        $page = $iDisplayStart/$iDisplayLength+1;
             
        $wells = $this->getWellModel()->find($search, true, $page);
        
        $rows = array();
        
        foreach($wells as $well) {
            $d = Zend_Json::decode(Zend_Json::encode($well));
            $rows[] = $d;
        }
        
        
        
        $tableArray = array();
        $tableArray['iTotalRecords'] = $wells->getTotalItemCount();
        $tableArray['iTotalDisplayRecords'] = $wells->count();
        $tableArray['aaData'] = $rows;
        $tableArray['aoData'] = array();
        echo Zend_Json::encode($tableArray, true);
    }
    
    public function viewAction()
    {
        $id = $this->getParam('id', 0);
        
        if($id < 1) {
            $data = array('code' => 500, 'response' => 'Missing required well id!');
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        $well = $this->getWellModel()->findById($id);
        
        if(count($well) == 0 ) {
            $data = array('code' => 500, 'response' => 'Could not find the well requested!');
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        $data = array(
        	'code' => 200,
            'response' => $well->toArray()
        );  
      
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function nearByAction() 
    {
        $id = $this->getParam('id', 0);
        $limit = $this->getParam('limit', 6);
        $distance = $this->getParam('distance', 25);
       
        if($id < 1) {
            $data = array('code' => 500, 'response' => 'Missing required well id!');
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        // load well
        $well = $this->getWellModel()->findById($id);
        if(count($well) == 0 ) {
            $data = array('code' => 500, 'response' => 'Could not find the well requested!');
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        
        // get nearby
        $nearBy = $this->getWellModel()->findNearBy($well->latitude, $well->longitude, $distance, $limit);
       
        $data = array(
                'code' => 200,
                'response' => $nearBy
        );
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function createCommentAction()
    {
        
        if(empty($this->getParam('wellCommentTxt'))) {
            $data = array('code' => 500,  'response' =>  "A Comment is required" );
          echo Zend_Json::encode($data, true);
          exit;
        }
        
        if( $this->getParam('wellId') < 1) {
            $data = array('code' => 500,  'response' =>  "Missing Well Id" );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        $data = array(
                'user_id' => $this->getIdentity()->auth_id,
                'well_id' => $this->getParam('wellId'),
                'well_comment_txt' => $this->getParam('wellCommentTxt'),
                'well_comment_private' => $this->getParam('wellCommentPrivate'),
                'well_comment_created' => time(),
                'well_comment_deleted' => 0,
        );
        
        try {
                
        $this->getWellModelComment()->create($data);
        
        $data = array(
                'code' => 200,
                'response' => "Comment saved"
        );
        
        } catch (Exception $e) {
           
            $data = array(
                    'code' => 500,
                    'response' =>  $e->getMessage()
            );
        }
        
        
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function updateCommentAction()
    {
        $id = $this->getParam('id');
        if($id < 1) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Missing comment id'
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        $wellCommentTxt = $this->getParam('wellCommentTxt');
        if(empty($wellCommentTxt)) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Comment Cannot be empty'
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        // load comment and check if we can delete it
        $comment = $this->getWellModelComment()->findById($id);
        if(empty($comment)) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Cannot find the comment requested'
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        if($comment->user_id != $this->getIdentity()->auth_id) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Access denied. You do not own this comment',
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        $data = array(
        	'well_comment_txt' => $wellCommentTxt
        );
        $this->getWellModelComment()->update($id, $data);
        
        $data = array(
                'code' => 200,
                'response' => "The Comment was updated."
        );
        
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function deleteCommentAction()
    {
        $id = $this->getParam('id');
        if($id < 1) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Missing comment id'
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        // load comment and check if we can delete it
        $comment = $this->getWellModelComment()->findById($id);
        if(empty($comment)) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Cannot find the comment requested'
            );
            echo Zend_Json::encode($data, true);
            exit;        
        }
        
        if($comment->user_id != $this->getIdentity()->auth_id) {
            $data = array(
                    'code' => 500,
                    'response' =>  'Access denied. You do not own this comment',
            );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        // we are good to delete the comment
        $this->getWellModelComment()->delete($id);
        
        $data = array(
                'code' => 200,
                'response' => "The Comment was deleted."
        );
        
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function getCommentsAction()
    {
        $id = $this->getParam('id');
        if($id < 1) {
            $data = array('code' => 500,  'response' =>  "Missing Well Id" );
            echo Zend_Json::encode($data, true);
            exit;
        }
        
        $comments = $this->getWellModelComment()->findByWell($id,false, false);
        
        $data = array(
                'code' => 200,
                'response' => $comments->toArray()
        );
        
        echo Zend_Json::encode($data, true);
        exit;
    }
    
    public function getCommentAction()
    {
        $id = $this->getParam('id');
        if($id < 1) {
            $data = array('code' => 500,  'response' =>  "Missing Well Id" );
            echo Zend_Json::encode($data, true);
            exit;
        } 
        
        $comment = $this->getWellModelComment()->findById($id);
        $data = array(
                'code' => 200,
                'response' => $comment->toArray()
        );
        
        echo Zend_Json::encode($data, true);
        exit;
        
    }
}