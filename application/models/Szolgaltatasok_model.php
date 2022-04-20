<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Szolgaltatasok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function szolgaltatasok_listazasa()
    {
        return $this->db->get('szolgaltatasok')->result_array();
    }

    public function szolgaltatas_rogzitese($data)
    {
        $this->db->insert('szolgaltatasok', $data);
        return $this->db->insert_id();
    }

    public function szolgaltatas_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('szolgaltatasok')->result_array();
    }

    public function szolgaltatas_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('szolgaltatasok', $data);
    }

    public function szolgaltatas_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('szolgaltatasok');
    }
}
?>