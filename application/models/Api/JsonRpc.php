<?php
class Application_Model_Api_JsonRpc
{

   /**
     * Return sum of two variables
     *
     * @param  int $x
     * @param  int $y
     * @return array
     */
   public function add($x, $y)
   {
      return array('result' => $x + $y); 
   }

}
