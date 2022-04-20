<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Ar extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('arak_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->arak_model->arak_listazasa();
        } else{
            $arak = $this->arak_model->ar_lekerdezese_id_alapjan($id);
            if (count($arak) > 0) {
                $data = $arak[0];
            } else {
                $response_code = REST_Controller::HTTP_NOT_FOUND;
            }
        }
        $this->response($data, $response_code);
    }

    public function index_post()
    {
        $adatok['ar'] = $this->post('ar');
        $adatok['allat_id'] = $this->post('allat_id');
        $adatok['rendelo_id'] = $this->post('rendelo_id');
        $adatok['szolgaltatas_id'] = $this->post('szolgaltatas_id');
        $id = $this->arak_model->ar_rogzitese($adatok);
        //$data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->arak_model->ar_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $arak = $this->arak_model->ar_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($arak) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található rendelő: '.$id];
        } else {
            $adatok['ar'] = $this->put('ar');
            $adatok['allat_id'] = $this->put('allat_id');
            $adatok['rendelo_id'] = $this->put('rendelo_id');
            $adatok['szolgaltatas_id'] = $this->put('szolgaltatas_id');
            $this->arak_model->ar_modositasa($id, $adatok);
            $data = $this->arak_model->ar_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $arak = $this->arak_model->ar_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($arak) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található ár: '.$id, "success" => false];
        } else {
            $this->arak_model->ar_torlese($id);
            $data = ['message' => 'Ár sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file ar.php */



?>