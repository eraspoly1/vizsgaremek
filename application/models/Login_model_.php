<?php
class Login_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    $this->load->database();
}
 
  function validate($email,$password){
    $this->db->where('email',$email);
    $this->db->where('jelszo',$password);
    $result = $this->db->get('felhasznalok','Admin');
    return $result;
  }
 
}