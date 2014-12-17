<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pruebas_model extends CI_Model {

    public function get_institutos() {
        $this->db_pruebas = $this->load->database('pruebas', TRUE);
        
        
        $SQL_string = "SELECT * FROM umbpruebas_instituciones";
        $SQL_string_query = $this->db_pruebas->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_espacios() {
        $this->db_pruebas = $this->load->database('pruebas', TRUE);
        
        $SQL_string = "SELECT * FROM umbpruebas_espacios e, umbpruebas_instituciones i "
                . "WHERE e.institucion_id = i.institucion_id";
        $SQL_string_query = $this->db_pruebas->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_inscritos() {
        $this->db_pruebas = $this->load->database('pruebas', TRUE);
        
        $SQL_string = "SELECT * FROM umbpruebas_inscritos";
        $SQL_string_query = $this->db_pruebas->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_inscritos_asignados() {
        $this->db_pruebas = $this->load->database('pruebas', TRUE);
        
        $SQL_string = "SELECT * FROM umbpruebas_inscritos i, umbpruebas_espacios e, umbpruebas_instituciones ins"
                . " WHERE i.espacio_id = e.espacio_id AND ins.institucion_id = e.institucion_id ";
        $SQL_string_query = $this->db_pruebas->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function asignar($data) {
        $this->db_pruebas = $this->load->database('pruebas', TRUE);
        
        $SQL_string = "( "
                . "'".$data['inscrito_pin']."',"
                . "'".$data['inscrito_cedula']."',"
                . "'".$data['inscrito_nombre']."',"
                . "'".$data['espacio_id']."',"
                . "'".$data['puesto']."'"
                . " ), ";
        
        echo $SQL_string.'<br>';
        //$SQL_string_query = $this->db_pruebas->query($SQL_string);
        //return $SQL_string_query->result();
    }

}
