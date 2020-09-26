<?php 
	class Api_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_details($table, $where='')
    {
        if($where){
    		$this->db->where($where);
    		$query = $this->db->get($table);
        	$result = $query->row();
    	}else{
    		$query = $this->db->get($table);
        	$result = $query->result();
    	}
        return $result ;
    }

    function get_row_details($table, $where='')
    {
        if($where){
            $this->db->where($where);
            $query = $this->db->get($table);
            $result = $query->row();
        }
        return $result ;
    }
    
    function get_mutltiple_row_details($table, $where='')
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        $result = $query->result();
        return $result ;
    }


    function get_num_rows($table, $where='')
    {
    	if($where){
    		$this->db->where($where);
    	}
        $query = $this->db->get($table);
        $result = $query->num_rows();
    	return $result ;
    }


    function insert_entry($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_entry($table, $where, $data)
    {
        $this->db->where($where);
        $result = $this->db->update($table, $data);
    	return $result ;
    }

}
?>
