<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistic_model extends CI_Model {

    public function get_prueba($ID_prueba) {
        $SQL_string = "SELECT * FROM siei_evaluaciones WHERE EVALUACION_ID=$ID_prueba";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    
    ///////////////////////////////////////////////////

    public function get_all_cuidades($ID_prueba) {
        $SQL_string = "SELECT u.USUARIO_CIUDAD, 
        				COUNT( u.USUARIO_ID ) TOTAL
						FROM siei_usuarios u, siei_evaluaciones e,siei_eva_usu eu
						WHERE u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND e.EVALUACION_ID = $ID_prueba
						GROUP BY u.USUARIO_CIUDAD";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    public function get_all_cuidades_porprueba($ID_prueba) {
        $SQL_string = "SELECT u.USUARIO_CIUDAD, COUNT( u.USUARIO_ID ) TOTAL
						FROM
						siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu
						WHERE 
						eu.EVALUACION_ID = e.EVALUACION_ID
						AND eu.USUARIO_ID = u.USUARIO_ID
						AND e.EVALUACION_ID = $ID_prueba
						AND (
						SELECT COUNT(USUARIO_ID) FROM siei_test t WHERE u.USUARIO_ID = t.USUARIO_ID
						) >0
						GROUP BY u.USUARIO_CIUDAD";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }  

    ///////////////////////////////////////////////////
    
    public function get_all_programas($ID_prueba,$USUARIO_CIUDAD) {
        $SQL_string = "SELECT u.USUARIO_PROGRAMA, 
        				COUNT( u.USUARIO_ID ) TOTAL
						FROM siei_usuarios u, siei_evaluaciones e,siei_eva_usu eu
						WHERE u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND e.EVALUACION_ID = $ID_prueba AND u.USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY u.USUARIO_PROGRAMA ORDER BY COUNT( u.USUARIO_ID )";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    public function get_all_programas_porprueba($ID_prueba,$USUARIO_CIUDAD) {
        $SQL_string = "SELECT u.USUARIO_PROGRAMA, COUNT( u.USUARIO_ID ) TOTAL
						FROM
						siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu
						WHERE 
						eu.EVALUACION_ID = e.EVALUACION_ID
						AND eu.USUARIO_ID = u.USUARIO_ID
						AND e.EVALUACION_ID = $ID_prueba AND u.USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						AND (
						SELECT COUNT(USUARIO_ID) FROM siei_test t WHERE u.USUARIO_ID = t.USUARIO_ID
						) >0
						GROUP BY u.USUARIO_PROGRAMA";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    } 
    public function get_all_dataprueba($ID_prueba,$USUARIO_CIUDAD) {
        $SQL_string = "SELECT 
						u.USUARIO_ID,
						u.USUARIO_PROGRAMA,
						ROUND(((count(t.RESPUESTA)*100)/75)/10,2) TOTAL
						FROM 
						siei_usuarios u,
						siei_test t,
						siei_evaluaciones e,
						siei_eva_usu eu
						WHERE 
						u.USUARIO_ID = t.USUARIO_ID
						AND u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND e.EVALUACION_ID = $ID_prueba AND u.USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						AND t.RESPUESTA=1
						GROUP BY u.USUARIO_ID ORDER BY ROUND(((count(t.RESPUESTA)*100)/75)/10,1)";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }  

    public function get_all_estrato($ID_prueba,$USUARIO_CIUDAD,$tipo) {
        $SQL_string = "SELECT USUARIO_ESTRATO , COUNT( USUARIO_ESTRATO ) AS TOTAL
						FROM siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu						
						WHERE
						u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND USUARIO_JORNADA = '$tipo'
						AND e.EVALUACION_ID = $ID_prueba AND USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY USUARIO_ESTRATO";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    } 
    public function get_all_genero($ID_prueba,$USUARIO_CIUDAD,$tipo) {
        $SQL_string = "SELECT USUARIO_GENERO , COUNT( USUARIO_GENERO ) AS TOTAL
						FROM siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu,
                                                siei_test t,
						WHERE
                                                u.USUARIO_ID = t.USUARIO_ID AND
						u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND USUARIO_JORNADA = '$tipo'
                                                    AND t.RESPUESTA=1
						AND e.EVALUACION_ID = $ID_prueba AND USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY USUARIO_GENERO";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    } 
    
    public function get_all_edad($ID_prueba,$USUARIO_CIUDAD,$tipo) {
        $SQL_string = "SELECT USUARIO_EDAD , COUNT( USUARIO_EDAD ) AS TOTAL, USUARIO_GENERO 
						FROM siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu						
						WHERE
						u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND USUARIO_JORNADA = '$tipo'
						AND e.EVALUACION_ID = $ID_prueba AND USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY USUARIO_EDAD,USUARIO_GENERO";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    } 

    public function get_all_colegio($ID_prueba,$USUARIO_CIUDAD,$tipo) {
        $SQL_string = "SELECT USUARIO_TIPOCOLEGIO , COUNT( USUARIO_TIPOCOLEGIO ) AS TOTAL, USUARIO_GENERO 
						FROM siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu						
						WHERE
						u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND USUARIO_JORNADA = '$tipo'
						AND e.EVALUACION_ID = $ID_prueba AND USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY USUARIO_TIPOCOLEGIO,USUARIO_GENERO";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    
    public function get_all_estadocivil($ID_prueba,$USUARIO_CIUDAD,$tipo) {
        $SQL_string = "SELECT USUARIO_ESTADOCIVIL , COUNT( USUARIO_ESTADOCIVIL ) AS TOTAL, USUARIO_GENERO 
						FROM siei_usuarios u,
						siei_evaluaciones e,
						siei_eva_usu eu						
						WHERE
						u.USUARIO_ID = eu.USUARIO_ID AND e.EVALUACION_ID = eu.EVALUACION_ID
						AND USUARIO_JORNADA = '$tipo'
						AND e.EVALUACION_ID = $ID_prueba AND USUARIO_CIUDAD = '$USUARIO_CIUDAD'
						GROUP BY USUARIO_ESTADOCIVIL,USUARIO_GENERO";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }    
    
    
    

}
