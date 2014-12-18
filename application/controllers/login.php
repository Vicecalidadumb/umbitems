<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('config_model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        $this->load->library('user_agent');
    }

    public function index() {
        //VALIDAR SI EL USUARIO CUENTA CON NAVEGADOR GOOGLE CHROME
        if ($this->agent->is_browser('Chrome')) {
            if ($this->session->userdata('logged_in')) {
                //SI EL USUARIO TIENE SESION ABIERTA, SE REDIRIGE A ESCRITORIO
                redirect('desk', 'refresh');
            } else {
                //SI EL USUARIO NO TIENE SESION ABIERTA, SE REDIRIGE A PAG. DE LOGIN
                $this->load->view('login/index', $config);
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Se recomienda utilizar el navegador <strong>GOOGLE CHROME</strong> para este aplicativo, lo puede descargar <a href="http://www.google.com/intl/es-419/chrome/" target="_blank">AQUI</a>', 'message_type' => 'danger'));
            redirect('login/error1', 'refresh');
        }
    }

    public function error1() {
        //MOSTRAR ERROR1: NAVEGADOR WEB NO RECOMENDADO.
        $this->load->view('login/chrome');
    }

    public function make_hash($var = 1) {
        //FUNCION GENERADORA DE CLAVES
        echo make_hash($var);
    }

    public function verify() {

        $username = $this->input->post('username');
        $pass = strip_tags(utf8_decode($this->input->post('password')));
        
        //CONSULTAR USUARIO
        $user = $this->user_model->get_user_username($username);
        //VERIFICAR SI EL USUARIO EXISTE
        if (count($user) > 0) {
            //VERIFICAR CONTRASEÑA CORRECTA
            if (verifyHash($pass, $user[0]->USUARIO_CLAVE) || check_password($pass, $user[0]->USUARIO_CLAVE)) {
                //OBTENER PERMISOS DE MODULOS PARA EL ROL ACTUAL
                $rol_permissions = $this->config_model->get_rol_permissions($user[0]->ID_TIPO_USU, 'SIGLA_MODULO');
                //GENERAR LAS VARIABLES DE SESION
                $newdata = array(
                    'USUARIO_ID' => $user[0]->USUARIO_ID,
                    'USUARIO_NUMERODOCUMENTO' => $user[0]->USUARIO_NUMERODOCUMENTO,
                    'USUARIO_NOMBRES' => $user[0]->USUARIO_NOMBRES,
                    'USUARIO_APELLIDOS' => $user[0]->USUARIO_APELLIDOS,
                    'USUARIO_CORREO' => $user[0]->USUARIO_CORREO,
                    'ID_TIPO_USU' => $user[0]->ID_TIPO_USU,
                    'HEADER_1' => '<div style="text-align: center">
                                        <img src="' . base_url('images/vice/ima1.png') . '" style="width: 600px;">  
                                    </div>
                                    <h1>Bienvenido</h1>
                                    <h4>' . $config['c_descripcion'] . '</h4>
                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>',
                    'HEADER_3' => '<div style="text-align: center">
                                        <img src="' . base_url('images/vice/ima1.png') . '" style="width: 600px;">  
                                    </div>
                                    ',
                    'HEADER_2' => '<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>',
                    'rol_permissions' => $rol_permissions,
                    'KEY_AES' => 'kjgw&&3%$&887Dvvc600',
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                
                //ENVIAR AL ESCRITORIO
                redirect('desk', 'location');
            } else {
                //ERROR EN CONTRASEÑA
                $this->session->set_flashdata(array('message' => '<strong>Error</strong> Contrase&ntilde;a Incorrecta.', 'message_type' => 'danger'));
                redirect('', 'refresh');
            }
        } else {
            //ERROR: USUARIO NO EXISTE O ESTA INACTIVO
            $this->session->set_flashdata(array('message' => 'Debe ingresar un Usuario Valido.', 'message_type' => 'warning'));
            redirect('', 'refresh');
        }
    }

    public function logout() {
        //FUNCION PARA SALIR DEL SISTEMA
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('login', 'location');
    }

}
