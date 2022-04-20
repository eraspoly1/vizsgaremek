<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rendelok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function rendelok_listazasa()
    {
        return $this->db->get('rendelok')->result_array();
    }

    public function rendelo_rogzitese($data)
    {
        $this->db->insert('rendelok', $data);
        return $this->db->insert_id();
    }

    public function rendelo_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('rendelok')->result_array();
    }

    public function rendelo_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('rendelok', $data);
    }

    public function rendelo_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rendelok');
    }

    public function keres($where)
    {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get('rendelok')->result_array();
    }
}
?>