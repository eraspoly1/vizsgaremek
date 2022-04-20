<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Velemenyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/velemeny';
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $velemenyek = json_decode($output, true);

        $data['velemenyek'] = $velemenyek;

        $fejlec_data['title'] = "Vélemények listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('velemenyek/listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Vélemény rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('velemenyek/rogzit');
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
                "message" => "<p>Az adott azonosítóval nem található vélemény</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú vélemény sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('velemenyek/index');
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
        $velemenyek = json_decode($output, true);
        if(count($velemenyek) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található vélemény</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $velemeny = $velemenyek;
        $data['velemeny'] = $velemeny;


        $fejlec_data['title'] = "Vélemény rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('velemenyek/modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('velemenyek/rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('felhasznalo_id', 'Felhasznalo ID', 'trim|required');
        $this->form_validation->set_rules('velemeny', 'Vélemény', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');
        
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('velemenyek/modosit/'.$id);
        }

        $data = [];
        $data['felhasznalo_id'] = $this->input->post('felhasznalo_id');
        $data['velemeny'] = $this->input->post('velemeny');
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
        $velemeny = json_decode($output, true);

        $success = "<p>$id azonosítójú vélemény sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('velemenyek/index');
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felhasznalo_id', 'Felhasznalo ID', 'trim|required');
        $this->form_validation->set_rules('velemeny', 'Vélemény', 'trim|required');
        $this->form_validation->set_rules('rendelo_id', 'Rendelő ID', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('velemenyek/rogzit');
        }
        else
        {
            $data = [];
            $data['felhasznalo_id'] = $this->input->post('felhasznalo_id');
            $data['velemeny'] = $this->input->post('velemeny');
            $data['rendelo_id'] = $this->input->post('rendelo_id');
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $velemeny = json_decode($output, true);
            $id = $velemeny['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott vélemény azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('velemenyek/index');
        }
    }
//???
    public function sajat_velemenyek()
	{
		$this->load->view('fejlec', ['oldal' => 'sajat_velemeny']);

		$id = $this->session->userdata('user')['felhasznalo_id'];

		$velemenyek = $this->velemenyek_model->get_where_user($id);

		$this->load->view('user/sajat_velemeny', ['velemenyek' => $velemenyek]);

		$this->load->view('lablec');
	}
}
?>