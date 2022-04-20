<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rendelok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/rendelo';
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $rendelok = json_decode($output, true);

        $data['rendelok'] = $rendelok;

        $fejlec_data['title'] = "Rendelők listája";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('rendelok/rendelo_listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Rendelő rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('rendelok/rendelo_rogzit');
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
                "message" => "<p>Az adott azonosítóval nem található rendelő</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú Rendelő sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('rendelok/index');
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
        $rendelok = json_decode($output, true);
        if(count($rendelok) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található rendelő</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $rendelo = $rendelok;
        $data['rendelo'] = $rendelo;


        $fejlec_data['title'] = "Rendelő rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('rendelok/rendelo_modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('rendelok/rendelo_rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('nev', 'Név', 'trim|required');
        $this->form_validation->set_rules('irsz', 'Irányítószám', 'trim|required');
        $this->form_validation->set_rules('telepules', 'Település', 'trim|required');
        $this->form_validation->set_rules('utca', 'Utca, házszám', 'trim|required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('rendelok/index/');
        }

        $data = [];
        $data['nev'] = $this->input->post('nev');
        $data['irsz'] = $this->input->post('irsz');
        $data['telepules'] = $this->input->post('telepules');
        $data['utca'] = $this->input->post('utca');
        $data['telefon'] = $this->input->post('telefon');
        $data['email'] = $this->input->post('email');
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        curl_close($ch);     
        $rendelo = json_decode($output, true);

        $success = "<p>$id azonosítójú rendelő sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('rendelok/index/');
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nev', 'Név', 'trim|required');
        $this->form_validation->set_rules('irsz', 'Irányítószám', 'trim|required');
        $this->form_validation->set_rules('telepules', 'Település', 'trim|required');
        $this->form_validation->set_rules('utca', 'Utca, házszám', 'trim|required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('rendelok/rendelo_rogzit');
        }
        else
        {
            $data = [];
            $data['nev'] = $this->input->post('nev');
            $data['irsz'] = $this->input->post('irsz');
            $data['telepules'] = $this->input->post('telepules');
            $data['utca'] = $this->input->post('utca');
            $data['telefon'] = $this->input->post('telefon');
            $data['email'] = $this->input->post('email');
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $rendelo = json_decode($output, true);
            $id = $rendelo['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott rendelő azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('rendelok/index');
        }
    }
}
?>