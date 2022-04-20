<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Allat extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('allatok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->allatok_model->allatok_listazasa();
        } else{
            $allatok = $this->allatok_model->allat_lekerdezese_id_alapjan($id);
            if (count($allatok) > 0) {
                $data = $allatok[0];
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
        $adatok['fajta'] = $this->post('fajta');
        $id = $this->allatok_model->allat_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->allatok_model->allat_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $allatok = $this->allatok_model->allat_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($allatok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található állat: '.$id];
        } else {
            $adatok['fajta'] = $this->put('fajta');
            $this->allatok_model->allat_modositasa($id, $adatok);
            $data = $this->allatok_model->allat_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $allatok = $this->allatok_model->allat_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($allatok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található állat: '.$id, "success" => false];
        } else {
            $this->allatok_model->allat_torlese($id);
            $data = ['message' => 'Állat sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file allat.php */



?>