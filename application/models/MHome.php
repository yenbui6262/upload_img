<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MHome extends MY_Model {
	public function save_upload($anh){
        
        $this->db->insert('tbl_anh', $anh);
        return $this->db->affected_rows();
    }
    public function get_anh(){
        
        return $this->db->get('tbl_anh')->result_array();
    }
}