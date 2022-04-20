<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Orvosok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/orvos';
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $orvosok = json_decode($output, true);

        $data['orvosok'] = $orvosok;

        $fejlec_data['title'] = "Orvosok listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('orvosok/listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Orvos rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('orvosok/rogzit');
        $this->load->view('lablec');
    }

    public function torol($id = "")
    {
        if ($id == "") {
            $data = array(
                "heading" => "Hiba",
                "message" => "<p>Az oldal nem található</p>"
            );
            $this->load->view("errors/html/error_404.php",$data);
            return;
        }
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $output = curl_exec($ch);
        curl_close($ch);     
        $eredmeny = json_decode($output, true);
        $sikeres = $eredmeny['success'];

        if(!$sikeres){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található orvos</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú orvos sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('orvosok/index');
    }

    public function modosit($id = "")
    {
        if ($id == "") {
            $data = array(
                "heading" => "Hiba",
                "message" => "<p>Az oldal nem található</p>"
            );
            $this->load->view("errors/html/error_404.php",$data);
            return;
        }
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $orvosok = json_decode($output, true);
        if(count($orvosok) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található orvos</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $orvos = $orvosok;
        $data['orvos'] = $orvos;


        $fejlec_data['title'] = "Orvos rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('orvosok/modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('orvosok/rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('elotag', 'Előtag', 'trim|required');
        $this->form_validation->set_rules('vnev', 'Vezetéknév', 'trim|required');
        $this->form_validation->set_rules('knev', 'Keresztnév', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelo ID', 'trim|required');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('orvosok/modosit/'.$id);
        }

        $data = [];
        $data['elotag'] = $this->input->post('elotag');
        $data['vnev'] = $this->input->post('vnev');
        $data['knev'] = $this->input->post('knev');
        $data['email'] = $this->input->post('email');
        $data['rendelo_id'] = $this->input->post('rendelo_id');
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        curl_close($ch);     
        $orvos = json_decode($output, true);

        $success = "<p>$id azonosítójú orvos sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('orvosok/modosit/'.$id);
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('elotag', 'Előtag', 'trim|required');
        $this->form_validation->set_rules('vnev', 'Vezetéknév', 'trim|required');
        $this->form_validation->set_rules('knev', 'Keresztnév', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('orvosok/rogzit');
        }
        else
        {
            $data = [];
            $data['elotag'] = $this->input->post('elotag');
            $data['vnev'] = $this->input->post('vnev');
            $data['knev'] = $this->input->post('knev');
            $data['email'] = $this->input->post('email');
            $data['rendelo_id'] = $this->input->post('rendelo_id');
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $orvos = json_decode($output, true);
            $id = $orvos['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott orvos azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('orvosok/index');
        }
    }
}
?>