<?php
class PNM_View_Helper_MovieGenre
{
    public function MovieGenre($genreName)
    {
       
        
        $GenreModel = new Application_Model_Genre();
        
        $genre = $GenreModel->findByName($genreName);
        
        return $genre->id;
    }
}