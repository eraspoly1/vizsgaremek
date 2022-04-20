<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Felhasznalok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/felhasznalo';

    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $felhasznalok = json_decode($output, true);

        $data['felhasznalok'] = $felhasznalok;

        $fejlec_data['title'] = "Felhasználók listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('felhasznalok/listaz', $data);
        
        $this->load->view('lablec');
    }

    public function rogzit()
    {
        $fejlec_data['title'] = "Felhasználó rögzítése";
        $this->load->view('fejlec', $fejlec_data);
        $this->load->view('felhasznalok/rogzit');
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
                "message" => "<p>Az adott azonosítóval nem található felhasználó</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú felhasználó sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('felhasznalok/index');
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
        $felhasznalok = json_decode($output, true);
        if(count($felhasznalok) == 0){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található felhasználó</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $felhasznalo = $felhasznalok;
        $data['felhasznalo'] = $felhasznalo;


        $fejlec_data['title'] = "Felhasználó rögzítése";
        $this->load->view('fejlec', $fejlec_data);

        $this->load->view('felhasznalok/modosit', $data);

        $this->load->view('lablec');
    }

    public function rogzit_get()
    {
        $this->load->view('felhasznalok/rogzit');       
    }

    public function modosit_vegrehajtas()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');
        $this->form_validation->set_rules('tipus', 'Felhasználó típusa', 'trim');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('felhasznalok/modosit/'.$id);
        }

        $data = [
            'felhasznalonev' => $this->input->post('felhasznalonev'),
            'email' => $this->input->post('email'),
            'jelszo' => password_hash($this->input->post('jelszo'), PASSWORD_BCRYPT),
            'tipus' => $this->input->post('tipus')
            ];
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        curl_close($ch);     
        $felhasznalo = json_decode($output, true);

        $success = "<p>$id azonosítójú felhasználó sikeresen módosítva</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('felhasznalok/modosit/'.$id);
    }

    public function rogzit_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');
        $this->form_validation->set_rules('tipus', 'Felhasználó típusa', 'trim');

        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $array['errors'] = $errors;
            $array['last_request'] = $this->input->post();
            $this->session->set_flashdata( $array );
            redirect('felhasznalok/rogzit');
        }
        else
        {
            $data = [
            'felhasznalonev' => $this->input->post('felhasznalonev'),
            'email' => $this->input->post('email'),
            'jelszo' => password_hash($this->input->post('jelszo'), PASSWORD_BCRYPT),
            'tipus' => $this->input->post('tipus')
            ];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $output = curl_exec($ch);
            curl_close($ch);     
            $felhasznalo = json_decode($output, true);
            $id = $felhasznalo['id'];

            $success = "<p>Sikeres Rögzítés, a létrehozott felhasználó azonosítója: $id</p>";
            $array['success'] = $success;
            $this->session->set_flashdata( $array );
            redirect('felhasznalok/index');
        }
    }

}
?>