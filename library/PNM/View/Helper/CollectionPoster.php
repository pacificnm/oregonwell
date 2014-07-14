<?php
class PNM_View_Helper_CollectionPoster
{
    public function CollectionPoster($collectionId, $type, $size)
    {
         
       
        
        if($collectionId < 1) {
            throw new Zend_Acl_Exception('Missing required parameter collectionId');
        }
        
        if(empty($type)) {
            throw new Zend_Acl_Exception('Missing required parameter type');
        }
        
        if(empty($size)) {
            throw new Zend_Acl_Exception('Missing required parameter size');
        }
        
        $appConfig = Zend_Registry::get('appConfig');
        
        $CollectionPosterModel = new Application_Model_CollectionPoster();
        
        $poster = $CollectionPosterModel->findByTypeSize($collectionId, $type, $size);
        
        $basePath = $appConfig->images->collection;
        
       if(!empty($poster)) {
           $img =  $basePath . '/' . $poster->collection_id . '/' .$type .'/' . $size . '/' . $poster->file_path ;
       } else {
           $img =  '';
       }
    
        
           
      return $img;
        
    }
}