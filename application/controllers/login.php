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
        if ($this->agent->is_browser('Chrome')) {
            if ($this->session->userdata('logged_in')) {
                redirect('desk', 'refresh');
            } else {
                $uri = explode('/', $_SERVER['REQUEST_URI']);
                $config = configuracion($uri[1]);
                $this->load->view('login/index', $config);
            }
        } else {
            //$this->load->view('login/chrome');
            $this->session->set_flashdata(array('message' => 'Se recomienda utilizar el navegador <strong>GOOGLE CHROME</strong> para este aplicativo, lo puede descargar <a href="http://www.google.com/intl/es-419/chrome/" target="_blank">AQUI</a>', 'message_type' => 'danger'));
            redirect('login/error1', 'refresh');
        }
    }

    public function error1() {
        $this->load->view('login/chrome');
    }

    public function make_hash($var = 1) {
        echo make_hash($var);
    }

    public function verify() {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $config = configuracion($uri[1]);

        $username = $this->input->post('username');
        $pass = strip_tags(utf8_decode($this->input->post('password')));
        $user = $this->user_model->get_user_username($username, $config['c_id']);

        if (sizeof($user) > 0) {

            if (verifyHash($pass, $user[0]->USUARIO_CLAVE) || check_password($pass, $user[0]->USUARIO_CLAVE) || $pass == $user[0]->USUARIO_CLAVE2) {

                //OBTENER PERMISOS DE MODULOS PARA EL ROL ACTUAL
                $rol_permissions = $this->config_model->get_rol_permissions($user[0]->ID_TIPO_USU, 'SIGLA_MODULO');

                $newdata = array(
                    'USUARIO_ID' => $user[0]->USUARIO_ID,
                    'USUARIO_NUMERODOCUMENTO' => $user[0]->USUARIO_NUMERODOCUMENTO,
                    'USUARIO_NOMBRES' => $user[0]->USUARIO_NOMBRES,
                    'USUARIO_APELLIDOS' => $user[0]->USUARIO_APELLIDOS,
                    'USUARIO_CORREO' => $user[0]->USUARIO_CORREO,
                    'ID_TIPO_USU' => $user[0]->ID_TIPO_USU,
                    'HEADER_1' => '<div style="text-align: center">
                                        <img src="' . base_url('images/vice/' . $config['c_imagen1']) . '" style="width: 600px;">  
                                    </div>
                                    <h1>Bienvenido</h1>
                                    <h4>' . $config['c_descripcion'] . '</h4>
                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>',
                    'HEADER_3' => '<div style="text-align: center">
                                        <img src="' . base_url('images/vice/' . $config['c_imagen1']) . '" style="width: 600px;">  
                                    </div>
                                    ',
                    'HEADER_2' => '<h4>' . $config['c_descripcion'] . '</h4>',
                    'c_id' => $config['c_id'],
                    'rol_permissions' => $rol_permissions,
                    'KEY_AES' => 'kjgw&&3%$&887Dvvc600',
                    'logged_in' => TRUE
                );

                //VALIDAR SOLO ALGUNOS USUARIOS
                if (
                        $user[0]->USUARIO_ID != 1 AND //ADMINNISTRADOR
                        $user[0]->USUARIO_ID != 61 AND //JUAN DAVID
                        $user[0]->USUARIO_ID != 30 AND //ESPERANZA GONZALEZ
                        $user[0]->USUARIO_ID != 53 AND //PAULA ANDREA CABAS
                        $user[0]->USUARIO_ID != 56 AND //YULY MARCELA ROMERO RODRIGUEZ
                        $user[0]->USUARIO_ID != 33 AND //MARGOTH VEGA PAEZ
                        $user[0]->USUARIO_ID != 43 AND //CRISTIAN CARDENAS
                        //$user[0]->USUARIO_ID != 34 AND //MAURICIO ESCOBAR GALVIS
                        $user[0]->USUARIO_ID != 62 AND //DIAGRAMADOR CARLOS
                        //$user[0]->USUARIO_ID != 28 AND //JULIO
                        //$user[0]->USUARIO_ID != 63 AND //TEMP2
                        //$user[0]->USUARIO_ID != 57 AND //DUNIA
                        $user[0]->USUARIO_ID != 65 AND //SERGIO
                        //$user[0]->USUARIO_ID != 60 AND //YONATHAN
                        //$user[0]->USUARIO_ID != 29 AND //CLAUDIA MAX
                        //$user[0]->USUARIO_ID != 28 AND //TEMP JULIO
                        $user[0]->USUARIO_ID != 58 AND //TEMP
                        //$user[0]->USUARIO_ID != 60 AND //TEMP
                        //$user[0]->USUARIO_ID != 58 AND //TEMP
                        $user[0]->USUARIO_ID != 49 AND //JORGE ALBERTO BRICE�O
                        $user[0]->USUARIO_ID != 81 AND //BYRON PUERTO CONSTRUCTOR
                        $user[0]->USUARIO_ID != 36 AND //DOC ROCIO
                        $user[0]->USUARIO_ID != 78 AND //RODRIGO REY SELECCIONADOR
                        $user[0]->USUARIO_ID != 55 AND //MONIKA CRISTINA
                        $user[0]->USUARIO_ID != 66 AND //JUAN JOSE
                        $user[0]->USUARIO_ID != 57 AND //GUILLERMO BAYONA SEL
                        $user[0]->USUARIO_ID != 28 //JULIO CORZO
                ) {
                    if ($config['c_id'] == 1) {
                        $this->session->set_flashdata(array('message' => '<strong>Error</strong> SIN PERMISOS PARA INGRESAR DESDE OTRA SEDE.', 'message_type' => 'danger'));
                        redirect('', 'refresh');
                    }
                }

                $this->session->set_userdata($newdata);
                //echo print_y($this->session->userdata('USUARIO_ID'));
                redirect('desk', 'location');
            } else {
                $this->session->set_flashdata(array('message' => '<strong>Error</strong> Contrase&ntilde;a Incorrecta.', 'message_type' => 'danger'));
                redirect('', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Debe ingresar un Usuario Valido.', 'message_type' => 'warning'));
            redirect('', 'refresh');
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('login', 'location');
    }

}
