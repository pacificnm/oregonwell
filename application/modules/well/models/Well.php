<?php

class Well_Model_Well extends Application_Model_Model
{

    /**
     *
     * @var unknown
     */
    private $_table = null;

    
    public function findAll()
    {
        $select = $this->getSelect()
        ->where("check_lat = ?", 0)
        ->where("lat_fail = ?", 0)    
        ->limit(50000);
        
        
        
        return $this->getRowSet($select, null, $this->getTable());
    }
    
    public function findById($id)
    {
        $select = $this->getSelect()->where('id = ?', $id);
        
        return $this->getRow($select, null, $this->getTable());
    }
    
    
    public function findNearBy($centerLat, $centerLng, $distance = 2, $limit = 20)
    {
        $sql = "SELECT *, ( 3959 * acos( cos( radians($centerLat) ) * cos( radians( latitude ) ) * cos( radians(  longitude ) - radians($centerLng) ) + sin( radians($centerLat) ) * sin( radians( latitude ) ) ) )
        	
        AS search_distance FROM well HAVING search_distance < $distance ORDER BY search_distance LIMIT $limit";
        
        
        $stmt = $this->getTable()
        ->getDefaultAdapter()
        ->query($sql);
        
        $rowset = $stmt->fetchAll();
        
        return $rowset;
        
    }
    
    public function find($search, $pagination = false, $page = 1) {
        $select = $this->getSelect();
        
    
        // county    
        if($search['filterCounty'][0] != "0") {
            $in = "'" .implode("', '", $search['filterCounty']) ."'";
            $select = $select->where('wl_county_code IN (' .$in. ')');   
        };
        
       // type
        if($search['filterType'][0] != "0") {
            $in = "'" .implode("', '", $search['filterType']) ."'";
            $select->where('type_of_log IN ('.$in.')');
        }
        
        // use filter
        if($search['filterUse'][0] != "0") {
           
            foreach($search['filterUse'] as $use) {
                $select->where($use . ' = ?', 1);
            }
        }
       
        //filterText
        if($search['filterText'] != "0") {
           $select->where('street LIKE ?', "%".$search['filterText']."%");           
        }
        
        
        
        if($pagination) {
            $paginator = Zend_Paginator::factory($select);
             
            $paginator->setItemCountPerPage(25)
            ->setPageRange(10)
            ->setCurrentPageNumber($page);
            
           
            
            $rowSet = $this->getPaginator($page, $select, null);
            return $rowSet;
        } else {
            return $this->getTable()->fetchAll($select);
        }
    }
    
    public function findEmpty()
    {
        
        $select = $this->getTable()
            ->getDefaultAdapter()
            ->query("SELECT  `well` . id 
            FROM  `well` 
            WHERE ! ( street_of_well >  '' ) 
            AND ! ( township >  '' )");
        
       
        
        return $select->fetchAll();
        
    }
    
    public function findByWellNbr($wellNbr)
    {
        $select = $this->getSelect()->where('wl_nbr = ?', $wellNbr);
        
        $rowSet = $this->getTable()->fetchRow($select);
        
        return $rowSet;
    }
    
    /**
     * Saves row to database
     *
     * @param array $data            
     * @throws Zend_Exception
     * @return int <mixed, multitype:>
     */
    public function create ($data)
    {
        try {
            
            $id = $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
            return $id;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
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
     * @return Well_Model_DbTable_Well
     */
    protected function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Well_Model_DbTable_Well();
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