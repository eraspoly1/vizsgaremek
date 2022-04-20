<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kezdolap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->library('session');
		$this->load->model('kereso_model');
		$this->load->model('felhasznalok_model');
		$this->api_url = base_url().'api/rendelo';
	}
    
	public function index($offset=0)
	{
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
	}

    public function reszletek($id)
	{
        $this->load->view('fejlec');
		$data['rendelo'] = $this->kereso_model->getById($id);
        $data['nyitvatartas'] = $this->kereso_model->getByIdNyitvatartas($id);
        $data['arak'] = $this->kereso_model->getByIdArak($id);
        $data['velemenyek'] = $this->kereso_model->getByIdVelemenyek($id);
		$this->load->view('rendelo_detail',$data);
        $this->load->view('lablec');
	}

    public function reszletek_nyitvatartas($id)
	{
        $this->load->view('fejlec');
        $data['nyitvatartas'] = $this->kereso_model->getByIdNyitvatartas($id);
		$this->load->view('kereso_detail',$data);
        $this->load->view('lablec');
	}

	public function regisztracio()
    {
        if ($this->session->userdata('user') !== NULL) {
            redirect('');
        }
        $this->load->view('fejlec', ['oldal' => 'regisztracio']);

        $this->load->view('regisztracio');

        #$this->load->view('add_vet');

        $this->load->view('lablec');
    }

    public function bejelentkezes()
    {
        if ($this->session->userdata('email') !== NULL) {
            redirect('');
        }
        #$this->load->view('fejlec', ['oldal' => 'bejelentkezes']);

        $this->load->view('login_view');

        $this->load->view('lablec');
    }

    function auth(){
        $email = $this->input->post('email', TRUE);
        $jelszo = password_verify($this->input->post('jelszo', TRUE), $jelszo);
        $validate = $this->kereso_model->validate($email,$jelszo);
        if($validate->num_rows() > 0){
            $data  = $validate->row_array();
            $name  = $data['felhasznalonev'];
            $email = $data['email'];
            $tipus = $data['tipus'];
            $sesdata = array(
                'felhasznalonev'  => $name,
                'email'     => $email,
                'tipus'     => $tipus,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            #var_dump($this->session->set_userdata($sesdata));
            // Belépés admin
            if($tipus === '1'){
                redirect('menu');
     
            // Belépés orvos
            } elseif($tipus === '2'){
                redirect('menu/orvos');
     
            // Belépés felhasználó
            } else {
                redirect('menu/user');
            }
        } else {
            echo $this->session->set_flashdata('msg','Hibás felhasználónév vagy jelszó');
            redirect('login');
        }
      }
/*
    public function regisztracio_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required|is_unique[felhasznalok.felhasznalonev]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[felhasznalok.email]');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');
        $this->form_validation->set_rules('jelszo_confirm', 'Jelszó megerősítése', 'trim|required|matches[jelszo]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('regisztracio');
        }

        $data = [
			'felhasznalonev' => $this->input->post('felhasznalonev'),
            'email' => $this->input->post('email'),
            'jelszo' => password_hash($this->input->post('jelszo'), PASSWORD_DEFAULT),
        ];
        $id = $this->felhasznalok_model->insert($data);
        $this->session->set_flashdata('success', "Sikeres regisztráció");
        redirect('bejelentkezes');
    }
*/
    public function bejelentkezes_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }
        $felhasznalonev = $this->input->post('felhasznalonev');

        $felhasznalo = $this->felhasznalok_model->search_by_username($felhasznalonev);

        if (empty($felhasznalo)) {
            $this->session->set_flashdata('error', "Hibás felhasználónév vagy jelszó!");
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }

        $jelszo = $this->input->post('jelszo');

        if (!password_verify($jelszo, $felhasznalo['jelszo'])) {
            $this->session->set_flashdata('error', "Hibás felhasználónév vagy jelszó!");
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }

        $array = array(
            'user' => $felhasznalo
        );

        $this->session->set_userdata($array);


        $this->session->set_flashdata('success', "Sikeres bejelentkezés");
        redirect('');
    }

    public function kijelentkezes()
	{	
		$this->session->unset_userdata('user');
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', "Sikeres kijelentkezés");
        redirect('');
	}

}