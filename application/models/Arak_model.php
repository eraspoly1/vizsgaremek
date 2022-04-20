<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Arak_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function arak_listazasa()
    {
        $this->db->select('arak.id,	arak.ar, allatok.fajta, rendelok.nev as name, szolgaltatasok.nev');
        $this->db->from('arak');
        $this->db->join('allatok', 'allatok.id = arak.allat_id');
        $this->db->join('szolgaltatasok', 'szolgaltatasok.id = arak.szolgaltatas_id');
        $this->db->join('rendelok', 'rendelok.id = arak.rendelo_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function ar_rogzitese($data)
    {
        $this->db->insert('arak', $data);
        return $this->db->insert_id();
    }

    public function ar_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('arak')->result_array();
    }

    public function ar_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('arak', $data);
    }

    public function ar_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('arak');
    }
}
?>