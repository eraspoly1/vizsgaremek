<?php
class Menu extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->helper('url');            
    $this->load->library('session');
    $this->load->model('kereso_model');
    $this->load->model('felhasznalok_model');
		$this->api_url = base_url().'api/rendelo';
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }

  }
 
  function index($offset=0){
    //Adminoknak
    if($this->session->userdata('tipus') === '1'){
    $fejlec_data['title'] = "Rendelők listája";
    $fejlec_data['stylesheets'] = ['listaz'];
    $this->load->view('fejlec');
		$this->load->library('pagination');
		$config['base_url'] = base_url('kezdolap/index');
		$config['total_rows'] = $this->kereso_model->countAll();
		$config['per_page'] = 8;
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';
		$config['reuse_query_string'] = TRUE;
		$data['kereso'] = $this->kereso_model->getAll($config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('admin/kezdolap_admin',$data);
		$this->load->view('lablec');
    } else {
        echo "Access Denied";
    }
 
  }
 
  /* Funkció fejlesztés alatt!
  function orvos($offset=0){
    //Orvosoknak
    if($this->session->userdata('tipus') === '2'){
      $fejlec_data['title'] = "Rendelők listája";
    $fejlec_data['stylesheets'] = ['listaz'];
    $this->load->view('fejlec');
		$this->load->library('pagination');
		$config['base_url'] = base_url('kezdolap/index');
		$config['total_rows'] = $this->kereso_model->countAll();
		$config['per_page'] = 8;
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';
		$config['reuse_query_string'] = TRUE;
		$data['kereso'] = $this->kereso_model->getAll($config['per_page'],$offset);
		$this->pagination->initialize($config);
    $this->load->view('kezdolap',$data);
    $this->load->view('lablec');
    } else {
        echo "Access Denied";
    }
  }
 */
  function user($offset=0){
    //Felhasználóknak
    if($this->session->userdata('tipus') === '3'){
      $fejlec_data['title'] = "Rendelők listája";
      $fejlec_data['stylesheets'] = ['listaz'];
      $this->load->view('fejlec');
      $this->load->library('pagination');
      $config['base_url'] = base_url('kezdolap/index');
      $config['total_rows'] = $this->kereso_model->countAll();
      $config['per_page'] = 8;
      $config['full_tag_open'] = '<ul class="pagination">';        
      $config['full_tag_close'] = '</ul>';        
      $config['first_link'] = 'First';        
      $config['last_link'] = 'Last';        
      $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
      $config['first_tag_close'] = '</span></li>';        
      $config['prev_link'] = '&laquo';        
      $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
      $config['prev_tag_close'] = '</span></li>';        
      $config['next_link'] = '&raquo';        
      $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
      $config['next_tag_close'] = '</span></li>';        
      $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
      $config['last_tag_close'] = '</span></li>';        
      $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
      $config['cur_tag_close'] = '</a></li>';        
      $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
      $config['num_tag_close'] = '</span></li>';
      $config['reuse_query_string'] = TRUE;
      $data['kereso'] = $this->kereso_model->getAll($config['per_page'],$offset);
      $this->pagination->initialize($config);
      $this->load->view('user/kezdolap_user',$data);
      $this->load->view('lablec');
    } else {
        echo "Access Denied";
    }
  }
 
}