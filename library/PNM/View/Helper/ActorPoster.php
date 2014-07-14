<?php
class PNM_View_Helper_ActorPoster
{
    public function ActorPoster($movieId, $image)
    {
        
        $img = '/images/actor/'.$movieId.'/w45/'.$image;
        return $img;         
    }
}