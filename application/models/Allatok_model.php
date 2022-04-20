<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Allatok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function allatok_listazasa()
    {
        return $this->db->get('allatok')->result_array();
    }

    public function allat_rogzitese($data)
    {
        $this->db->insert('allatok', $data);
        return $this->db->insert_id();
    }

    public function allat_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('allatok')->result_array();
    }

    public function allat_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('allatok', $data);
    }

    public function allat_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('allatok');
    }
}
?>