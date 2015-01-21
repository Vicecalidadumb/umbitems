<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'COM';

        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('user_model');
        $this->load->model('component_model');
        $this->load->model('question_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function vb_constructor($state, $COMPONENTE_ID) {
        $COMPONENTE_ID = deencrypt_id($COMPONENTE_ID);

        switch ($state) {
            case 0:
                $data = array(
                    'COMPONENTE_OKCONSTRUCTOR' => 1,
                    'COMPONENTE_OKCONSTRUCTOR_FECHA' => date("Y-m-d H:i:s"),
                    'COMPONENTE_ID' => $COMPONENTE_ID,
                    'COMPONENTE_OKCONSTRUCTOR_ID' => $this->session->userdata('USUARIO_ID')
                );
                break;
            default:
                $data = array(
                    'COMPONENTE_OKCONSTRUCTOR' => 0,
                    'COMPONENTE_OKCONSTRUCTOR_FECHA' => '0000-00-00 00:00:00',
                    'COMPONENTE_ID' => $COMPONENTE_ID,
                    'COMPONENTE_OKCONSTRUCTOR_ID' => $this->session->userdata('USUARIO_ID')
                );
                break;
        }

        $insert = $this->component_model->update_component_vobo($data);

        if ($insert) {
            $this->session->set_flashdata(array('message' => 'Componente Actualizada con Exito.', 'message_type' => 'info'));
            redirect('desk', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Actualizar el Componente.', 'message_type' => 'error'));
            redirect('desk', 'refresh');
        }
    }

    public function index() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->component_model->get_components();

        $data['title'] = 'Componetes';
        $data['content'] = 'component/index';
        $this->load->view('template/template', $data);
    }

    public function view() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->component_model->get_components();

        $data['title'] = 'Componetes';
        $data['content'] = 'component/report';
        $this->load->view('template/template', $data);
    }

    public function report2() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->component_model->get_components_report2();

        header("Content-type: application/octet-stream; charset=UTF-8");
        header("Content-Disposition: attachment; filename=reporte_items_construidos_" . date("Y_m_d_H_i_s") . ".xls");
        header('Content-Type: text/html; charset=UTF-8');
        header("Pragma: no-cache");
        header("Expires: 0");


        //$data['content'] = 'component/report2';
        $this->load->view('component/report2', $data);
    }

    public function random($var = 6, $items = '') {
        validation_permission_role($this->module_sigla, 'permission_view');
        if ($items != '') {
            echo $items;
        } else {
            $data['components'] = $this->component_model->get_components();

            $data['var_random'] = $var;

            $data['title'] = 'Componetes';
            $data['content'] = 'component/random';
            $this->load->view('template/template', $data);
        }
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['users'] = get_dropdown($this->user_model->get_all_users_rol(), 'USUARIO_ID', 'USUARIO_NOMBRES');

        $data['title'] = 'Nuevo Componente';
        $data['content'] = 'component/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {

        //echo print_y($this->input->post());
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data = array(
            'COMPONENTE_NOMBRE' => $this->input->post('COMPONENTE_NOMBRE', TRUE),
            'COMPONENTE_SIGLA' => $this->input->post('COMPONENTE_SIGLA', TRUE),
            'COMPONENTE_ESTADO' => 1,
            'COMPONENTE_PREGUNTAS' => $this->input->post('COMPONENTE_PREGUNTAS', TRUE),
            'USUARIO_IDs' => $this->input->post('USUARIO_IDs', TRUE)
        );

        $insert = $this->component_model->insert_component($data);

        if ($insert) {

            $insert_2 = $this->component_model->insert_component_users($data, $insert);

            $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
            redirect('index.php/component', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al insertar el registro', 'message_type' => 'error'));
            redirect('index.php/component', 'refresh');
        }
    }

    public function edit($COMPONENTE_ID) {
        $COMPONENTE_ID = deencrypt_id($COMPONENTE_ID);

        validation_permission_role($this->module_sigla, 'permission_edit');

        $data['component'] = $this->component_model->get_component_id($COMPONENTE_ID);
        if (count($data['component']) > 0) {

            $data['users'] = get_dropdown($this->user_model->get_all_users_rol(), 'USUARIO_ID', 'USUARIO_NOMBRES');

            $data['title'] = 'Editar Componente';
            $data['content'] = 'component/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('index.php/user', 'refresh');
        }
    }

    public function update() {
        validation_permission_role($this->module_sigla, 'permission_edit');

        $data = array(
            'COMPONENTE_ID' => $this->input->post('COMPONENTE_ID', TRUE),
            'COMPONENTE_NOMBRE' => $this->input->post('COMPONENTE_NOMBRE', TRUE),
            'COMPONENTE_SIGLA' => $this->input->post('COMPONENTE_SIGLA', TRUE),
            'COMPONENTE_ESTADO' => 1,
            'COMPONENTE_PREGUNTAS' => $this->input->post('COMPONENTE_PREGUNTAS', TRUE),
            'USUARIO_IDs' => $this->input->post('USUARIO_IDs', TRUE)
        );

        $update = $this->component_model->update_component($data);
        //echo print_y($update);
        if ($update) {
            $insert_2 = $this->component_model->insert_component_users($data, $data['COMPONENTE_ID']);
            $this->session->set_flashdata(array('message' => 'Registro editado con exito', 'message_type' => 'info'));
            redirect('index.php/component', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al editar el Registro', 'message_type' => 'warning'));
            redirect('index.php/component', 'refresh');
        }
    }

    public function report3() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->question_model->get_questions_report3('ALL','ALL',$this->session->userdata("KEY_AES"),0);
        
        header("Content-type: application/octet-stream; charset=UTF-8");
        header("Content-Disposition: attachment; filename=reporte_items_construidos_" . date("Y_m_d_H_i_s") . ".xls");
        header('Content-Type: text/html; charset=UTF-8');
        header("Pragma: no-cache");
        header("Expires: 0");
        

        //$data['content'] = 'component/report2';
        $this->load->view('component/report3', $data);
    }

}
