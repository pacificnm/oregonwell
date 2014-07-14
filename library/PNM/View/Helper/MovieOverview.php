<?php
class PNM_View_Helper_MovieOverview
{
    public function MovieOverview($movieId)
    {
        $movieModel = new Application_Model_Movie();
        $movie = $movieModel->findById($movieId);
        
        return $movie;
    }
}