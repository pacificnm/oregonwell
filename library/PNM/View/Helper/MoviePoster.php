<?php
class PNM_View_Helper_MoviePoster 
{
    public function MoviePoster($movieId, $type, $size)
    {
        $posterModel = new Application_Model_MoviePoster();
        $poster = $posterModel->findByTypeSize($movieId, $type, $size);

        
       
        
       return '/images/movie/' . $movieId . '/' . $type . '/' . $size .'/' . $poster->file_path;
      
        
       
    }
}