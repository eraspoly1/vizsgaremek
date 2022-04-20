<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Szolgaltatas extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('szolgaltatasok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->szolgaltatasok_model->szolgaltatasok_listazasa();
        } else{
            $szolgaltatasok = $this->szolgaltatasok_model->szolgaltatas_lekerdezese_id_alapjan($id);
            if (count($szolgaltatasok) > 0) {
                $data = $szolgaltatasok[0];
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
        $adatok['leiras'] = $this->post('leiras');
        $id = $this->szolgaltatasok_model->szolgaltatas_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->szolgaltatasok_model->szolgaltatas_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $szolgaltatasok = $this->szolgaltatasok_model->szolgaltatas_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($szolgaltatasok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található szolgáltatás: '.$id];
        } else {
            $adatok['nev'] = $this->put('nev');
            $adatok['leiras'] = $this->put('leiras');
            $this->szolgaltatasok_model->szolgaltatas_modositasa($id, $adatok);
            $data = $this->szolgaltatasok_model->szolgaltatas_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $szolgaltatasok = $this->szolgaltatasok_model->szolgaltatas_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($szolgaltatasok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található szolgáltatás: '.$id, "success" => false];
        } else {
            $this->szolgaltatasok_model->szolgaltatas_torlese($id);
            $data = ['message' => 'Szolgáltatás sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file szolgaltatas.php */



?>