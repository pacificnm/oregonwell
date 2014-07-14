<?php
interface PNM_Model_Interface
{
    /**
     * Finds all database records
     */
    public function findAll();
    
    /**
     * Finds All records Paginated
     * @param unknown $page
     */
    public function findAllPaginated($page);
    
    /**
     * finds database record by primary key
     */
    public function findById($id);
    
    /**
     * inserts row into database
     * @param array $data fields
     */
    public function create($data);
    
    /**
     * Updates database row
     * @param int $id
     * @param array $data
     */
    public function update($id, $data);
    
    /**
     * Deletes a database row
     * @param int $id
     */
    public function delete($id);
    
    /**
     * gets the table
     */
    public function getTable();
    
}