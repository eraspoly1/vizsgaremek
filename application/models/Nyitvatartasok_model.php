<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Nyitvatartasok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function nyitvatartasok_listazasa()
    {
        $this->db->select('nyitvatartasok.id, nyitvatartasok.nap, nyitvatartasok.nyitas, nyitvatartasok.zaras, rendelok.nev as rendelo_nev');
        $this->db->select('CASE nap  WHEN 0 THEN \'Vasárnap\' 
                                     WHEN 1 THEN \'Hétfő\' 
                                     WHEN 2 THEN \'Kedd\' 
                                     WHEN 3 THEN \'Szerda\' 
                                     WHEN 4 THEN \'Csütörtök\' 
                                     WHEN 5 THEN \'Péntek\' 
                                     WHEN 6 THEN \'Szombat\' 
                                     END nap');
        $this->db->from('nyitvatartasok');
        $this->db->join('rendelok', 'rendelok.id = nyitvatartasok.rendelo_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function nyitvatartas_rogzitese($data)
    {
        $this->db->insert('nyitvatartasok', $data);
        return $this->db->insert_id();
    }

    public function nyitvatartas_lekerdezese_id_alapjan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('nyitvatartasok')->result_array();
    }

    public function nyitvatartas_modositasa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('nyitvatartasok', $data);
    }

    public function nyitvatartas_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nyitvatartasok');
    }

    public function getNapok() {
        $this->db->select('CASE nap  WHEN 0 THEN \'Vasárnap\' 
                                     WHEN 1 THEN \'Hétfő\' 
                                     WHEN 2 THEN \'Kedd\' 
                                     WHEN 3 THEN \'Szerda\' 
                                     WHEN 4 THEN \'Csütörtök\' 
                                     WHEN 5 THEN \'Péntek\' 
                                     WHEN 6 THEN \'Szombat\' 
                                     END nap');
        $this->db->from('nyitvatartasok');
        $query = $this->db->get()->result_array();
        return $query;
    }

}
?>