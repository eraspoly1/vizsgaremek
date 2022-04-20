<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Velemenyek_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function velemenyek_listazasa()
    {
        $this->db->select('velemenyek.id, felhasznalok.felhasznalonev, velemenyek.velemeny, rendelok.nev');
        $this->db->from('velemenyek');
        $this->db->join('rendelok', 'rendelok.id = velemenyek.rendelo_id');
        $this->db->join('felhasznalok', 'felhasznalok.id = velemenyek.felhasznalo_id');
        $query = $this->db->get()->result_array();
        return $query;

    }

    public function velemeny_rogzitese($data)
    {
        $this->db->insert('velemenyek', $data);
        return $this->db->insert_id();
    }

    public function velemeny_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('velemenyek')->result_array();
    }

    public function velemeny_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('velemenyek', $data);
    }

    public function velemeny_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('velemenyek');
    }

    public function get_where_user($id)
	{
        $this->db->where('felhasznalo_id', $id);
        return $this->db->get('velemenyek')->result_array();
	}
}
?>