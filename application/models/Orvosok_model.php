<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Orvosok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function orvosok_listazasa()
    {
        $this->db->select('orvosok.id, orvosok.elotag, orvosok.vnev, orvosok.knev, orvosok.email, rendelok.nev');
        $this->db->from('orvosok');
        $this->db->join('rendelok', 'rendelok.id = orvosok.rendelo_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function orvos_rogzitese($data)
    {
        $this->db->insert('orvosok', $data);
        return $this->db->insert_id();
    }

    public function orvos_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('orvosok')->result_array();
    }

    public function orvos_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('orvosok', $data);
    }

    public function orvos_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('orvosok');
    }

    public function get_redelo_by_id($rendelo_id)
	{
		$this->db->where('rendelo_id', $rendelo_id);
		return $this->db->get('rendelok')->result_array();
	}
}
?>