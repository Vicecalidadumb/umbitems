<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Desk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('component_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        
        $data['title'] = 'Universidad Manuela Beltran, Sistema de Administraci&oacute;n de &Iacute;tems. - Inicio';
        $data['content'] = 'index';

        //$data['components_array'] = $this->component_model->get_components_id_user_2($this->session->userdata('USUARIO_ID'));
        //$data['components_array_2'] = $this->component_model->get_components_id_user_3($this->session->userdata('USUARIO_ID'));
        //$data['components_array_3'] = $this->component_model->get_components_id_user_4($this->session->userdata('USUARIO_ID'));

        $this->load->view('template/template', $data);
    }

}
