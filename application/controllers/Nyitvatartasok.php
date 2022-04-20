<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Nyitvatartasok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/nyitvatartas';
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $nyitvatartasok = json_decode($output, true);

        $data['nyitvatartasok'] = $nyitvatartasok;

        $fejlec_data['title'] = "Nyitvatartások listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('nyitvatartasok/listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Nyitvatartás rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('nyitvatartasok/rogzit');
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
                "message" => "<p>Az adott azonosítóval nem található nyitvatartás</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú nyitvatartás sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('nyitvatartasok/index');
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
        $nyitvatartasok = json_decode($output, true);
        if(count($nyitvatartasok) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található nyitvatartás</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $nyitvatartas = $nyitvatartasok;
        $data['nyitvatartas'] = $nyitvatartas;


        $fejlec_data['title'] = "Nyitvatartás rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('nyitvatartasok/modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('nyitvatartasok/rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('nap', 'Nap', 'trim|required');
        $this->form_validation->set_rules('nyitas', 'Nyitás', 'trim|required');
        $this->form_validation->set_rules('zaras', 'Zárás', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('nyitvatartasok/modosit/'.$id);
        }

        $data = [];
        $data['nap'] = $this->input->post('nap');
        $data['nyitas'] = $this->input->post('nyitas');
        $data['zaras'] = $this->input->post('zaras');
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
        $nyitvatartas = json_decode($output, true);

        $success = "<p>$id azonosítójú nyitvatartás sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('nyitvatartasok/modosit/'.$id);
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nap', 'Nap', 'trim|required');
        $this->form_validation->set_rules('nyitas', 'Nyitás', 'trim|required');
        $this->form_validation->set_rules('zaras', 'Zárás', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('nyitvatartasok/rogzit');
        }
        else
        {
            $data = [];
            $data['nap'] = $this->input->post('nap');
            $data['nyitas'] = $this->input->post('nyitas');
            $data['zaras'] = $this->input->post('zaras');
            $data['rendelo_id'] = $this->input->post('rendelo_id');
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $nyitvatartas = json_decode($output, true);
            $id = $nyitvatartas['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott nyitvatartás azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('nyitvatartasok/index');
        }
    }
}
?>