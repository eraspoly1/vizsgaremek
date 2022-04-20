<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Felhasznalo extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('felhasznalok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->felhasznalok_model->felhasznalok_listazasa();
        } else{
            $felhasznalok = $this->felhasznalok_model->felhasznalo_lekerdezese_id_alapjan($id);
            if (count($felhasznalok) > 0) {
                $data = $felhasznalok[0];
            } else {
                $response_code = REST_Controller::HTTP_NOT_FOUND;
            }
        }
        $this->response($data, $response_code);
    }

    public function index_post()
    {
        $adatok['felhasznalonev'] = $this->post('felhasznalonev');
        $adatok['email'] = $this->post('email');
        $adatok['jelszo'] = $this->post('jelszo');
        $adatok['tipus'] = $this->post('tipus');
        $id = $this->felhasznalok_model->felhasznalo_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->felhasznalok_model->felhasznalo_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $felhasznalok = $this->felhasznalok_model->felhasznalo_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($felhasznalok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található felhasználó: '.$id];
        } else {
            $adatok['felhasznalonev'] = $this->put('felhasznalonev');
            $adatok['email'] = $this->put('email');
            $adatok['jelszo'] = $this->put('jelszo');
            $adatok['tipus'] = $this->put('tipus');
            $this->felhasznalok_model->felhasznalo_modositasa($id, $adatok);
            $data = $this->felhasznalok_model->felhasznalo_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $felhasznalok = $this->felhasznalok_model->felhasznalo_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($felhasznalok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található felhasználó: '.$id, "success" => false];
        } else {
            $this->felhasznalok_model->felhasznalo_torlese($id);
            $data = ['message' => 'Felhasználó sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file felhasznalo.php */



?>