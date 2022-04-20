<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Orvos extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('orvosok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->orvosok_model->orvosok_listazasa();
        } else{
            $orvosok = $this->orvosok_model->orvos_lekerdezese_id_alapjan($id);
            if (count($orvosok) > 0) {
                $data = $orvosok[0];
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

        $adatok['elotag'] = $this->post('elotag');
        $adatok['vnev'] = $this->post('vnev');
        $adatok['knev'] = $this->post('knev');
        $adatok['email'] = $this->post('email');
        $adatok['rendelo_id'] = $this->post('rendelo_id');
        $id = $this->orvosok_model->orvos_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->orvosok_model->orvos_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $orvosok = $this->orvosok_model->orvos_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($orvosok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található orvos: '.$id];
        } else {
            $adatok['elotag'] = $this->put('elotag');
            $adatok['vnev'] = $this->put('vnev');
            $adatok['knev'] = $this->put('knev');
            $adatok['email'] = $this->put('email');
            $adatok['rendelo_id'] = $this->put('rendelo_id');
            $this->orvosok_model->orvos_modositasa($id, $adatok);
            $data = $this->orvosok_model->orvos_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $orvosok = $this->orvosok_model->orvos_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($orvosok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található orvos: '.$id, "success" => false];
        } else {
            $this->orvosok_model->orvos_torlese($id);
            $data = ['message' => 'Orvos sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file orvos.php */



?>