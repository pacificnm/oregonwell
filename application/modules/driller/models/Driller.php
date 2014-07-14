<?php
class Driller_Model_Driller extends Application_Model_Model
{

    /**
     *
     * @var unknown
     */
    private $_table = null;

    
    
    public function create($data)
    {
        $id = $this->getTable()->insert($data);
        
        return $id;
    }
    
    public function update($id, $data)
    {
        $where = $this->getTable()->getDefaultAdapter()->quoteInto('id = ?', $id);
        
        $this->getTable()->update($data, $where);
    }
    
    
    public function delete($id)
    {
        $where = $this->getTable()->getDefaultAdapter()->quoteInto('id = ?', $id);
        
        $this->getTable()->delete($where);
    }
    
    /**
     *
     * @return Driller_Model_DbTable_Driller
     */
    protected function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Driller_Model_DbTable_Driller();
            return $this->_table;
        }
    }
    
    function strToAddress($context) {
        $array = explode(" ", $context);
        $array_reversed = array_reverse($array);
        $numKey = "";
        $zipKey = "";
    
        foreach($array_reversed as $k=>$str) {
            if($zipKey) { continue; }
            if(strlen($str)===5 && is_numeric($str)) {
                $zipKey = $k;
            }
        }
        $array_reversed = array_slice($array_reversed, $zipKey);
        $array = array_reverse($array_reversed);
    
        foreach($array as $k=>$str) {
            if($numKey) { continue; }
            if(strlen($str)>1 && strlen($str)<6 && is_numeric($str)) {
                $numKey = $k;
            }
    
        }
        $array = array_slice($array, $numKey);
    
    
    
        $string = implode(' ', $array);
        return $string;
    }
}