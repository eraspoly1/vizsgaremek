<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Product_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
     
    function get_category(){
        $query = $this->db->get('category');
        return $query;  
    }
 
    function get_sub_category($category_id){
        $query = $this->db->get_where('sub_category', array('subcategory_category_id' => $category_id));
        return $query;
    }
     
}