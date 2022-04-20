<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Velemeny extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('velemenyek_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->velemenyek_model->velemenyek_listazasa();
        } else{
            $velemenyek = $this->velemenyek_model->velemeny_lekerdezese_id_alapjan($id);
            if (count($velemenyek) > 0) {
                $data = $velemenyek[0];
            } else {
                $response_code = REST_Controller::HTTP_NOT_FOUND;
            }
        }
        $this->response($data, $response_code);
    }

    public function index_post()
    {
       
        $adatok['felhasznalo_id'] = $this->post('felhasznalo_id');
        $adatok['velemeny'] = $this->post('velemeny');
        $adatok['rendelo_id'] = $this->post('rendelo_id');
        $id = $this->velemenyek_model->velemeny_rogzitese($adatok);
        //$data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->velemenyek_model->velemeny_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $velemenyek = $this->velemenyek_model->velemeny_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($velemenyek) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található vélemény: '.$id];
        } else {
            $adatok['felhasznalo_id'] = $this->put('felhasznalo_id');
            $adatok['velemeny'] = $this->put('velemeny');
            $adatok['rendelo_id'] = $this->put('rendelo_id');
            $this->velemenyek_model->velemeny_modositasa($id, $adatok);
            $data = $this->velemenyek_model->velemeny_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $velemenyek = $this->velemenyek_model->velemeny_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($velemenyek) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található vélemény: '.$id, "success" => false];
        } else {
            $this->velemenyek_model->velemeny_torlese($id);
            $data = ['message' => 'Vélemény sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file velemeny.php */



?>