<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Arak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/ar';

    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $arak = json_decode($output, true);

        $data['arak'] = $arak;

        $fejlec_data['title'] = "Árak listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('arak/listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Ár rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('arak/rogzit');
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
                "message" => "<p>Az adott azonosítóval nem található ár</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú ár sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('arak/index');
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
        $arak = json_decode($output, true);
        if(count($arak) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található ár</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $ar = $arak;
        $data['ar'] = $ar;


        $fejlec_data['title'] = "Ár rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('arak/modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('arak/rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ar', 'Ár', 'trim|required');
        $this->form_validation->set_rules('allat_id', 'Állat ID', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');
        $this->form_validation->set_rules('szolgaltatas_id', 'Szolgáltatás ID', 'trim|required');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('arak/modosit/'.$id);
        }

        $data = [];
        $data['ar'] = $this->input->post('ar');
        $data['allat_id'] = $this->input->post('allat_id');
        $data['rendelo_id'] = $this->input->post('rendelo_id');
        $data['szolgaltatas_id'] = $this->input->post('szolgaltatas_id');
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        curl_close($ch);     
        $ar = json_decode($output, true);

        $success = "<p>$id azonosítójú ár sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('arak/modosit/'.$id);
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ar', 'Ár', 'trim|required');
        $this->form_validation->set_rules('allat_id', 'Állat ID', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');
        $this->form_validation->set_rules('szolgaltatas_id', 'Szolgáltatás ID', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('arak/rogzit');
        }
        else
        {
            $data = [];
            $data['ar'] = $this->input->post('ar');
            $data['allat_id'] = $this->input->post('allat_id');
            $data['rendelo_id'] = $this->input->post('rendelo_id');
            $data['szolgaltatas_id'] = $this->input->post('szolgaltatas_id');

            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $ar = json_decode($output, true);
            $id = $ar['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott ár azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('arak/index');
        }
    }
}
?>