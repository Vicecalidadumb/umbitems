<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'PRE';

        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('user_model');
        $this->load->model('question_model');
        $this->load->model('component_model');
        $this->load->model('validation_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function view($id_user = '0', $id_component = '0') {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        if ($id_user == '0') {
            if ($this->session->userdata('ID_TIPO_USU') == 1 or $this->session->userdata('ID_TIPO_USU') == 2 or $this->session->userdata('ID_TIPO_USU') == 5) {
                if ($this->session->userdata('ID_TIPO_USU') == 1 or $this->session->userdata('ID_TIPO_USU') == 5) {
                    //CONSULTAR USUARIOS TIPO 2 = CONSTRUCTORES DE ITEMS
                    $data['users'] = get_dropdown($this->user_model->get_all_users_type(2), 'USUARIO_ID', 'NOMBRES_C');
                    $data['title'] = 'Buscara Items - Seleccion del Usuario';
                    $data['content'] = 'question/select_user_view';
                    $this->load->view('template/template', $data);
                } else {
                    redirect('/question/view/' . encrypt_id($this->session->userdata('USUARIO_ID')), 'refresh');
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No Posee Permisos para Realizar esta Accion.', 'message_type' => 'warning'));
                redirect('/desk', 'refresh');
            }
        } else {

            //VERIFICAR USUARIO
            $id_user = deencrypt_id($id_user);

            $components_array = $this->component_model->get_components_id_user($id_user);
            $data['components'] = get_dropdown($components_array, 'COMPONENTE_ID', 'COMPONENTE_NOMBRE');

            if (count($components_array) > 0) {
                if ($id_component == '0') {
                    $data['user'] = $this->user_model->get_user_id_user($id_user);
                    $data['id_user'] = $id_user;
                    $data['title'] = 'Buscar Items - Seleccion del Componente';
                    $data['content'] = 'question/select_component_view';
                    $this->load->view('template/template', $data);
                } else {
                    $data['user'] = $this->user_model->get_user_id_user($id_user);
                    $id_component = deencrypt_id($id_component);
                    $component_validate = $this->component_model->get_components_id_user_id_component($id_user, $id_component);

                    if (count($component_validate) > 0) {
                        //BUSCAR ITEMS
                        //$data['component'] = $this->component_model->get_components_id($id_component);
                        $data['id_component'] = $id_component;
                        $data['id_user'] = $id_user;

                        $data['questions'] = $this->question_model->get_questions($id_component, $id_user, $this->session->userdata("KEY_AES"), 1);
                        $data['component'] = $this->component_model->get_components_id_est($id_component);

                        $data['title'] = 'Buscar Items';
                        $data['content'] = 'question/view';
                        $this->load->view('template/template', $data);
                    } else {
                        $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                        redirect('/desk', 'refresh');
                    }
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                redirect('/desk', 'refresh');
            }
        }
    }

    public function add($id_user = '0', $id_component = '0') {

        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        if ($id_user == '0') {
            if ($this->session->userdata('ID_TIPO_USU') == 1 or $this->session->userdata('ID_TIPO_USU') == 2) {
                if ($this->session->userdata('ID_TIPO_USU') == 1) {
                    //CONSULTAR USUARIOS TIPO 2 = CONSTRUCTORES DE ITEMS
                    $data['users'] = get_dropdown($this->user_model->get_all_users_type(2), 'USUARIO_ID', 'NOMBRES_C');
                    $data['title'] = 'Agregar Nuevo Items - Seleccion del Usuario';
                    $data['content'] = 'question/select_user';
                    $this->load->view('template/template', $data);
                } else {
                    redirect('/question/add/' . encrypt_id($this->session->userdata('USUARIO_ID')), 'refresh');
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No Posee Permisos para Realizar esta Accion.', 'message_type' => 'warning'));
                redirect('/desk', 'refresh');
            }
        } else {

            //VERIFICAR USUARIO
            $id_user = deencrypt_id($id_user);

            $components_array = $this->component_model->get_components_id_user($id_user);
            $data['components'] = get_dropdown($components_array, 'COMPONENTE_ID', 'COMPONENTE_NOMBRE');

            if (count($components_array) > 0) {
                if ($id_component == '0') {
                    $data['user'] = $this->user_model->get_user_id_user($id_user);
                    $data['id_user'] = $id_user;
                    $data['title'] = 'Agregar Nuevo Items - Seleccion del Componente';
                    $data['content'] = 'question/select_component';
                    $this->load->view('template/template', $data);
                } else {
                    $data['user'] = $this->user_model->get_user_id_user($id_user);
                    $id_component = deencrypt_id($id_component);
                    $component_validate = $this->component_model->get_components_id_user_id_component($id_user, $id_component);

                    if (count($component_validate) > 0) {
                        //REALIZACION DEL ITEM
                        $data['component'] = $this->component_model->get_components_id($id_component);
                        $data['id_component'] = $id_component;
                        $data['id_user'] = $id_user;
                        $data['title'] = 'Agregar Nuevo Item';
                        $data['content'] = 'question/add';
                        if ($this->session->userdata('USUARIO_ID') == 58)
                            $data['content'] = 'question/add';
                        $this->load->view('template/template', $data);
                    } else {
                        $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                        redirect('/desk', 'refresh');
                    }
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                redirect('/desk', 'refresh');
            }
        }
    }

    public function insert2() {
        echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';
    }

    public function insert() {
        
        //echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';
        /*
          $PREGUNTA_ENUNCIADO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_ENUNCIADO'));
          $PREGUNTA_CONTEXTO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_CONTEXTO'));
          $RESPUESTA_ENUNCIADO_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_1'));
          $RESPUESTA_JUSTIFICACION_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_1'));
          $RESPUESTA_ENUNCIADO_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_2'));
          $RESPUESTA_JUSTIFICACION_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_2'));
          $RESPUESTA_ENUNCIADO_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_3'));
          $RESPUESTA_JUSTIFICACION_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_3'));
          $RESPUESTA_ENUNCIADO_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_4'));
          $RESPUESTA_JUSTIFICACION_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_4'));
         */

        $PREGUNTA_ENUNCIADO = $this->input->post('PREGUNTA_ENUNCIADO');
        $PREGUNTA_CONTEXTO = $this->input->post('PREGUNTA_CONTEXTO');
        $RESPUESTA_ENUNCIADO_1 = $this->input->post('RESPUESTA_ENUNCIADO_1');
        $RESPUESTA_JUSTIFICACION_1 = $this->input->post('RESPUESTA_JUSTIFICACION_1');
        $RESPUESTA_ENUNCIADO_2 = $this->input->post('RESPUESTA_ENUNCIADO_2');
        $RESPUESTA_JUSTIFICACION_2 = $this->input->post('RESPUESTA_JUSTIFICACION_2');
        $RESPUESTA_ENUNCIADO_3 = $this->input->post('RESPUESTA_ENUNCIADO_3');
        $RESPUESTA_JUSTIFICACION_3 = $this->input->post('RESPUESTA_JUSTIFICACION_3');
        $RESPUESTA_ENUNCIADO_4 = $this->input->post('RESPUESTA_ENUNCIADO_4');
        $RESPUESTA_JUSTIFICACION_4 = $this->input->post('RESPUESTA_JUSTIFICACION_4');

        $data = array(
            'PREGUNTA_TEMA' => $this->input->post('PREGUNTA_TEMA'),
            'PREGUNTA_TIPOITEM' => $this->input->post('PREGUNTA_TIPOITEM'),
            'PREGUNTA_NIVELRUBRICA' => $this->input->post('PREGUNTA_NIVELRUBRICA'),
            'PREGUNTA_NIVELPREGUNTA' => $this->input->post('PREGUNTA_NIVELPREGUNTA'),
            'PREGUNTA_NIVELDIFICULTAD' => $this->input->post('PREGUNTA_NIVELDIFICULTAD'),
            'PREGUNTA_ENUNCIADO' => $PREGUNTA_ENUNCIADO,
            'PREGUNTA_CONTEXTO' => $PREGUNTA_CONTEXTO,
            'PREGUNTA_IDRESPUESTA' => $this->input->post('PREGUNTA_IDRESPUESTA'),
            'PREGUNTA_OBSERVACIONES' => $this->input->post('PREGUNTA_OBSERVACIONES'),
            'PREGUNTA_ETAPA' => $this->input->post('PREGUNTA_ETAPA'),
            'RESPUESTA_ENUNCIADO_1' => $RESPUESTA_ENUNCIADO_1,
            'RESPUESTA_JUSTIFICACION_1' => $RESPUESTA_JUSTIFICACION_1,
            'RESPUESTA_ENUNCIADO_2' => $RESPUESTA_ENUNCIADO_2,
            'RESPUESTA_JUSTIFICACION_2' => $RESPUESTA_JUSTIFICACION_2,
            'RESPUESTA_ENUNCIADO_3' => $RESPUESTA_ENUNCIADO_3,
            'RESPUESTA_JUSTIFICACION_3' => $RESPUESTA_JUSTIFICACION_3,
            'RESPUESTA_ENUNCIADO_4' => $RESPUESTA_ENUNCIADO_4,
            'RESPUESTA_JUSTIFICACION_4' => $RESPUESTA_JUSTIFICACION_4,
            'PREGUNTA_FECHADECREACION' => date("Y-m-d H:i:s"),
            'USUARIO_ID' => $this->input->post('USUARIO_ID'),
            'COMPONENTE_ID' => $this->input->post('COMPONENTE_ID'),
        );
        $insert = $this->question_model->insert_question($data, $this->session->userdata("KEY_AES"));
        if ($insert) {
            $this->session->set_flashdata(array('message' => 'Item Agregado con Exito.', 'message_type' => 'info'));
            redirect('desk', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Agregar el Item.', 'message_type' => 'error'));
            redirect('desk', 'refresh');
        }
    }

    public function update() {
        //echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';

        $question = $this->question_model->get_question($this->input->post('PREGUNTA_ID', TRUE), $this->session->userdata("KEY_AES"));

        /*
        $PREGUNTA_ENUNCIADO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_ENUNCIADO'));
        $PREGUNTA_CONTEXTO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_CONTEXTO'));
        $RESPUESTA_ENUNCIADO_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_1'));
        $RESPUESTA_JUSTIFICACION_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_1'));
        $RESPUESTA_ENUNCIADO_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_2'));
        $RESPUESTA_JUSTIFICACION_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_2'));
        $RESPUESTA_ENUNCIADO_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_3'));
        $RESPUESTA_JUSTIFICACION_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_3'));
        $RESPUESTA_ENUNCIADO_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_4'));
        $RESPUESTA_JUSTIFICACION_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_4'));
         * 
         */
        
        $PREGUNTA_ENUNCIADO = $this->input->post('PREGUNTA_ENUNCIADO');
        $PREGUNTA_CONTEXTO = $this->input->post('PREGUNTA_CONTEXTO');
        $RESPUESTA_ENUNCIADO_1 = $this->input->post('RESPUESTA_ENUNCIADO_1');
        $RESPUESTA_JUSTIFICACION_1 = $this->input->post('RESPUESTA_JUSTIFICACION_1');
        $RESPUESTA_ENUNCIADO_2 = $this->input->post('RESPUESTA_ENUNCIADO_2');
        $RESPUESTA_JUSTIFICACION_2 = $this->input->post('RESPUESTA_JUSTIFICACION_2');
        $RESPUESTA_ENUNCIADO_3 = $this->input->post('RESPUESTA_ENUNCIADO_3');
        $RESPUESTA_JUSTIFICACION_3 = $this->input->post('RESPUESTA_JUSTIFICACION_3');
        $RESPUESTA_ENUNCIADO_4 = $this->input->post('RESPUESTA_ENUNCIADO_4');
        $RESPUESTA_JUSTIFICACION_4 = $this->input->post('RESPUESTA_JUSTIFICACION_4');        

        $data = array(
            'PREGUNTA_ID' => $this->input->post('PREGUNTA_ID'),
            'PREGUNTA_TEMA' => $this->input->post('PREGUNTA_TEMA'),
            'PREGUNTA_TIPOITEM' => $this->input->post('PREGUNTA_TIPOITEM'),
            'PREGUNTA_NIVELRUBRICA' => $this->input->post('PREGUNTA_NIVELRUBRICA'),
            'PREGUNTA_NIVELPREGUNTA' => $this->input->post('PREGUNTA_NIVELPREGUNTA'),
            'PREGUNTA_NIVELDIFICULTAD' => $this->input->post('PREGUNTA_NIVELDIFICULTAD'),
            'PREGUNTA_ENUNCIADO' => $PREGUNTA_ENUNCIADO,
            'PREGUNTA_CONTEXTO' => $PREGUNTA_CONTEXTO,
            'PREGUNTA_IDRESPUESTA' => $this->input->post('PREGUNTA_IDRESPUESTA'),
            'PREGUNTA_OBSERVACIONES' => $this->input->post('PREGUNTA_OBSERVACIONES'),
            'PREGUNTA_FECHADECREACION' => date("Y-m-d H:i:s"),
            'PREGUNTA_ETAPA' => $this->input->post('PREGUNTA_ETAPA'),
            'RESPUESTA_ENUNCIADO_1' => $RESPUESTA_ENUNCIADO_1,
            'RESPUESTA_JUSTIFICACION_1' => $RESPUESTA_JUSTIFICACION_1,
            'RESPUESTA_ENUNCIADO_2' => $RESPUESTA_ENUNCIADO_2,
            'RESPUESTA_JUSTIFICACION_2' => $RESPUESTA_JUSTIFICACION_2,
            'RESPUESTA_ENUNCIADO_3' => $RESPUESTA_ENUNCIADO_3,
            'RESPUESTA_JUSTIFICACION_3' => $RESPUESTA_JUSTIFICACION_3,
            'RESPUESTA_ENUNCIADO_4' => $RESPUESTA_ENUNCIADO_4,
            'RESPUESTA_JUSTIFICACION_4' => $RESPUESTA_JUSTIFICACION_4,
            'question' => $question
        );
        $insert = $this->question_model->update_question($data, $this->session->userdata("KEY_AES"));

        if ($insert) {
            $this->session->set_flashdata(array('message' => 'Pregunta Actualizada con Exito.', 'message_type' => 'info'));
            redirect('desk', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Actualizar la Pregunta.', 'message_type' => 'error'));
            redirect('desk', 'refresh');
        }
    }

    public function select_user() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');
        $id_user = $this->input->post('USUARIO_ID', TRUE);
        redirect('/question/add/' . encrypt_id($id_user), 'refresh');
    }

    public function select_user_view() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');
        $id_user = $this->input->post('USUARIO_ID', TRUE);
        redirect('/question/view/' . encrypt_id($id_user), 'refresh');
    }

    public function select_component($id_user) {
        validation_permission_role($this->module_sigla, 'permission_add');
        $id_component = $this->input->post('COMPONENTE_ID', TRUE);
        redirect('/question/add/' . encrypt_id($id_user) . '/' . encrypt_id($id_component), 'refresh');
    }

    public function select_component_view($id_user) {
        validation_permission_role($this->module_sigla, 'permission_view');
        $id_component = $this->input->post('COMPONENTE_ID', TRUE);
        redirect('/question/view/' . encrypt_id($id_user) . '/' . encrypt_id($id_component), 'refresh');
    }

    public function edit($id_question) {
        //VALIDAR PERMISO DEL ROL (SIEMPRE Y CUANDO EL USUARIO NO SE EDITE A SI MISMO)
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_question = deencrypt_id($id_question);
        $data['id_question'] = $id_question;

        $data['question'] = $this->question_model->get_question($id_question, $this->session->userdata("KEY_AES"));
        if (count($data['question']) > 0) {
            $data['title'] = 'Editar Item';
            $data['content'] = 'question/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'error'));
            redirect('user', 'refresh');
        }
    }

    public function preview($id_question) {
        //VALIDAR PERMISO DEL ROL (SIEMPRE Y CUANDO EL USUARIO NO SE EDITE A SI MISMO)
        validation_permission_role($this->module_sigla, 'permission_view');

        $id_question = deencrypt_id($id_question);
        $data['id_question'] = $id_question;

        $data['question'] = $this->question_model->get_question($id_question, $this->session->userdata("KEY_AES"));
        if (count($data['question']) > 0) {
            $data['title'] = 'Vista del Item';
            $data['content'] = 'question/preview';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'error'));
            redirect('user', 'refresh');
        }
    }

    public function view_validation($id_question) {
        //validation_permission_role($this->module_sigla, 'permission_edit');

        $data['validation'] = $this->validation_model->get_validation_view(deencrypt_id($id_question));

        $id_question = deencrypt_id($id_question);
        $data['id_question'] = $id_question;

        $data['question'] = $this->question_model->get_question($id_question, $this->session->userdata("KEY_AES"));

        if (count($data['question']) > 0) {
            $data['title'] = 'Ver Validar';
            $data['content'] = 'question/view_validation';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'error'));
            redirect('user', 'refresh');
        }
    }

    public function edit_question($id_question) {
        //MODIFICAR PREGUNTA
        //validation_permission_role('VMO', 'permission_edit');

        $id_question = deencrypt_id($id_question);
        $data['id_question'] = $id_question;

        $data['question'] = $this->question_model->get_question($id_question, $this->session->userdata("KEY_AES"));

        if (count($data['question']) > 0) {
            $data['title'] = 'Modificar Item';
            $data['content'] = 'question/edit_question';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'error'));
            redirect('user', 'refresh');
        }
    }

    public function update_modify() {
        //echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';

        $question = $this->question_model->get_question($this->input->post('PREGUNTA_ID', TRUE), $this->session->userdata("KEY_AES"));

        $PREGUNTA_ENUNCIADO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_ENUNCIADO'));
        $PREGUNTA_CONTEXTO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_CONTEXTO'));
        $PREGUNTA_OBSERVACIONES = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_OBSERVACIONES'));

        $RESPUESTA_ENUNCIADO_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_1'));
        $RESPUESTA_JUSTIFICACION_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_1'));
        $RESPUESTA_ENUNCIADO_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_2'));
        $RESPUESTA_JUSTIFICACION_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_2'));
        $RESPUESTA_ENUNCIADO_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_3'));
        $RESPUESTA_JUSTIFICACION_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_3'));
        $RESPUESTA_ENUNCIADO_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_4'));
        $RESPUESTA_JUSTIFICACION_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_4'));

        $data = array(
            'PREGUNTA_ID' => $this->input->post('PREGUNTA_ID', TRUE),
            'PREGUNTA_MODIFICACION_ENUNCIADO' => $PREGUNTA_ENUNCIADO,
            'PREGUNTA_MODIFICACION_CONTEXTO' => $PREGUNTA_CONTEXTO,
            'PREGUNTA_MODIFICACION_OBSERVACIONES' => $PREGUNTA_OBSERVACIONES,
            'PREGUNTA_MODIFICACION_FECHA' => date("Y-m-d H:i:s"),
            'PREGUNTA_MODIFICACION_IDUSUARIOCREADOR' => $this->session->userdata('USUARIO_ID'),
            'RESPUESTA_ENUNCIADO_1' => $RESPUESTA_ENUNCIADO_1,
            'RESPUESTA_ENUNCIADO_2' => $RESPUESTA_ENUNCIADO_2,
            'RESPUESTA_ENUNCIADO_3' => $RESPUESTA_ENUNCIADO_3,
            'RESPUESTA_ENUNCIADO_4' => $RESPUESTA_ENUNCIADO_4,
            'RESPUESTA_JUSTIFICACION_1' => $RESPUESTA_JUSTIFICACION_1,
            'RESPUESTA_JUSTIFICACION_2' => $RESPUESTA_JUSTIFICACION_2,
            'RESPUESTA_JUSTIFICACION_3' => $RESPUESTA_JUSTIFICACION_3,
            'RESPUESTA_JUSTIFICACION_4' => $RESPUESTA_JUSTIFICACION_4,
            'question' => $question
        );
        $insert = $this->question_model->update_question_modify($data, $this->session->userdata("KEY_AES"));

        if ($insert) {

            //MODIFICAR NIVEL DE RUBRICA
            $PREGUNTA_NIVELRUBRICA = $this->input->post('PREGUNTA_NIVELRUBRICA', TRUE);
            $this->question_model->update_question_rubrica($PREGUNTA_NIVELRUBRICA, $this->input->post('PREGUNTA_ID', TRUE));

            //MODIFICAR TEMA
            $PREGUNTA_TEMA = $this->input->post('PREGUNTA_TEMA', TRUE);
            $this->question_model->update_question_tema($PREGUNTA_TEMA, $this->input->post('PREGUNTA_ID', TRUE));

            //MODIFICAR NIVEL DE DIFICULTAD
            $PREGUNTA_NIVELDIFICULTAD = $this->input->post('PREGUNTA_NIVELDIFICULTAD', TRUE);
            $this->question_model->update_question_dificultad($PREGUNTA_NIVELDIFICULTAD, $this->input->post('PREGUNTA_ID', TRUE));

            $this->session->set_flashdata(array('message' => 'Pregunta Modificada con Exito.', 'message_type' => 'info'));
            if ($this->session->userdata('ID_TIPO_USU') == 3 or $this->session->userdata('ID_TIPO_USU') == 4) {
                redirect('validation/add/' . encrypt_id($this->session->userdata('USUARIO_ID')) . '/' . encrypt_id($question[0]->COMPONENTE_ID), 'refresh');
                //base_url("validation/add/" . encrypt_id($this->session->userdata('USUARIO_ID')) . "/" . encrypt_id($component->COMPONENTE_ID))
            } else {
                redirect('desk', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Modificar la Pregunta.', 'message_type' => 'error'));
            redirect('desk', 'refresh');
        }
    }

    public function validate_send_ajax() {
        //sleep(1);
        echo "validation_ok";
    }

    public function view_pdf($id_user = '0', $id_component = '0') {

        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        if ($id_user == '0') {
            echo "Error al Consultar";
        } else {

            //VERIFICAR USUARIO
            $id_user = deencrypt_id($id_user);

            $components_array = $this->component_model->get_components_id_user($id_user);
            $data['components'] = get_dropdown($components_array, 'COMPONENTE_ID', 'COMPONENTE_NOMBRE');

            if (count($components_array) > 0) {
                if ($id_component == '0') {
                    echo "Error al Consultar";
                } else {
                    $data['user'] = $this->user_model->get_user_id_user($id_user);
                    $id_component = deencrypt_id($id_component);
                    $component_validate = $this->component_model->get_components_id_user_id_component($id_user, $id_component);

                    if (count($component_validate) > 0) {
                        //BUSCAR ITEMS
                        //$data['component'] = $this->component_model->get_components_id($id_component);
                        $data['id_component'] = $id_component;
                        $data['id_user'] = $id_user;

                        $data['questions'] = $this->question_model->get_questions($id_component, $id_user, $this->session->userdata("KEY_AES"), 1);
                        $data['component'] = $this->component_model->get_components_id_est($id_component);

                        $data['title'] = 'Buscar Items';
                        $data['content'] = 'question/view_pdf';
                        $this->load->view('template/template', $data);

//                        $this->load->view('question/view_pdf', $data);
//                        
                    } else {
                        $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                        redirect('/desk', 'refresh');
                    }
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
                redirect('/desk', 'refresh');
            }
        }
    }

}
