<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Felhasznalok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        $this->db->insert('felhasznalok', $data);
        return $this->db->insert_id();
    }

    public function search_by_username($username)
    {
        $this->db->where('felhasznalonev', $username);
        return $this->db->get('felhasznalok')->row_array();
    }
    
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('felhasznalok')->row_array();
    }
    
    public function felhasznalok_listazasa()
    {
        return $this->db->get('felhasznalok')->result_array();
    }

    public function felhasznalo_rogzitese($data)
    {
        $this->db->insert('felhasznalok', $data);
        return $this->db->insert_id();
    }

    public function felhasznalo_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('felhasznalok')->result_array();
    }

    public function felhasznalo_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('felhasznalok', $data);
    }

    public function felhasznalo_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('felhasznalok');
    }

    public function get_where_user($user_id)
	{
        $this->db->where('id', $user_id);
        return $this->db->get('felhasznalok')->result_array();
	}
}
?>