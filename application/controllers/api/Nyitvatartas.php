<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Nyitvatartas extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('nyitvatartasok_model');        
    }

    public function index_get($id = 0)
    {
        $data = [];
        $response_code = REST_Controller::HTTP_OK;
        if ($id == 0) {   
            $data = $this->nyitvatartasok_model->nyitvatartasok_listazasa();
        } else{
            $nyitvatartasok = $this->nyitvatartasok_model->nyitvatartas_lekerdezese_id_alapjan($id);
            if (count($nyitvatartasok) > 0) {
                $data = $nyitvatartasok[0];
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


        $adatok['nap'] = $this->post('nap');
        $adatok['nyitas'] = $this->post('nyitas');
        $adatok['zaras'] = $this->post('zaras');
        $adatok['rendelo_id'] = $this->post('rendelo_id');
        $id = $this->nyitvatartasok_model->nyitvatartas_rogzitese($adatok);
        $data = ['Sikeres felvétel, azonosító '.$id];
        $data = $this->nyitvatartasok_model->nyitvatartas_lekerdezese_id_alapjan($id)[0];
        $this->response($data, REST_Controller::HTTP_CREATED);
        
    }

    public function index_put($id)
    {
        $nyitvatartasok = $this->nyitvatartasok_model->nyitvatartas_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($nyitvatartasok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['A megadott azonosítóval nem található nyitvatartás: '.$id];
        } else {
            $adatok['nap'] = $this->put('nap');
            $adatok['nyitas'] = $this->put('nyitas');
            $adatok['zaras'] = $this->put('zaras');
            $adatok['rendelo_id'] = $this->put('rendelo_id');
            $this->nyitvatartasok_model->nyitvatartas_modositasa($id, $adatok);
            $data = $this->nyitvatartasok_model->nyitvatartas_lekerdezese_id_alapjan($id)[0];
        }
        $this->response($data, $response_code);
    }

    public function index_delete($id)
    {
        $nyitvatartasok = $this->nyitvatartasok_model->nyitvatartas_lekerdezese_id_alapjan($id);
        $response_code = REST_Controller::HTTP_OK;
        $data = [];
        if (count($nyitvatartasok) == 0) {
            $response_code = REST_Controller::HTTP_NOT_FOUND;
            $data = ['message' => 'A megadott azonosítóval nem található nyitvatartás: '.$id, "success" => false];
        } else {
            $this->nyitvatartasok_model->nyitvatartas_torlese($id);
            $data = ['message' => 'Nyitvatartás sikeresen törölve: '.$id, "success" => true];
        }
        $this->response($data, $response_code);
        
    }

}

/* End of file nyitvatartas.php */



?>