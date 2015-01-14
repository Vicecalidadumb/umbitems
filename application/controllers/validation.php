<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'VAL';

        $this->load->helper('miscellaneous');
        $this->load->helper('security');

        $this->load->model('validation_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function insert($COMPONENTE_ID, $PREGUNTA_NIVELPREGUNTA) {
        $insert = $this->validation_model->update_question_validate();
        if ($insert) {
            $this->session->set_flashdata(array('message' => 'Pregunta Actualizada con Exito.', 'message_type' => 'info'));
            redirect('index.php/question/view/' . $COMPONENTE_ID . '/' . $PREGUNTA_NIVELPREGUNTA, 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Actualizar la Pregunta.', 'message_type' => 'error'));
            redirect('index.php/selection/view/' . $COMPONENTE_ID . '/' . $PREGUNTA_NIVELPREGUNTA, 'refresh');
        }
    }

}
