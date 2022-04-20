<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Rendelo extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('rendelok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->rendelok_model->rendelok_listazasa();
        } else{
            $rendelok = $this->rendelok_model->rendelo_lekerdezese_id_alapjan($id);
            if (count($rendelok) > 0) {
                $data = $rendelok[0];
            } else {
                $response_code = REST_Controller::HTTP_NOT_FOUND;
            }
        }
        $this->response($data, $response_code);
    }

    public function index_post()
    {
        /*
        $this->load->library('form_validation');
        $this->form_validation->set_rules('gyarto', 'Gyártó', 'trim|required');
        $this->form_validation->set_rules('modell', 'Modell', 'trim|required');
        $this->form_validation->set_rules('uzembehelyezes', 'Üzembehelyezés éve', 'trim|numeric|greater_than[1900]|less_than_equal_to[2021]|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $data['errors'] = $errors;
        }
        */


        $adatok['nev'] = $this->post('nev');
        $adatok['irsz'] = $this->post('irsz');
        $adatok['telepules'] = $this->post('telepules');
        $adatok['utca'] = $this->post('utca');
        $adatok['telefon'] = $this->post('telefon');
        $adatok['email'] = $this->post('email');
        $id = $this->rendelok_model->rendelo_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->rendelok_model->rendelo_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $rendelok = $this->rendelok_model->rendelo_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($rendelok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található rendelő: '.$id];
        } else {
            $adatok['nev'] = $this->put('nev');
            $adatok['irsz'] = $this->put('irsz');
            $adatok['telepules'] = $this->put('telepules');
            $adatok['utca'] = $this->put('utca');
            $adatok['telefon'] = $this->put('telefon');
            $adatok['email'] = $this->put('email');
            $this->rendelok_model->rendelo_modositasa($id, $adatok);
            $data = $this->rendelok_model->rendelo_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $rendelok = $this->rendelok_model->rendelo_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($rendelok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található rendelő: '.$id, "success" => false];
        } else {
            $this->rendelok_model->rendelo_torlese($id);
            $data = ['message' => 'Rendelő sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file rendelo.php */



?>