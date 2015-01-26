<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component_model extends CI_Model {

    public function get_components() {
        $SQL_string = "SELECT c.*,
                        (
                        SELECT GROUP_CONCAT(CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS) SEPARATOR '<br>') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u,
                        umbitems_tipos_usuario t
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND t.ID_TIPO_USU = u.ID_TIPO_USU
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID AND u.ID_TIPO_USU=2
                        )
                        ASIGNADOS,
                        (
                        SELECT COUNT(p.PREGUNTA_ID) FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        ITEMS,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELRUBRICA   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELRUBRICAS,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELDIFICULTAD   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELDIFICULTAD                  
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        COMPONENTE_ESTADO = '1'";
        //echo $SQL_string;  
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_report2() {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,
                        (
                        SELECT GROUP_CONCAT(CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS,': <strong>',t.NOM_TIPO_USU) SEPARATOR '</strong><br>') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u,
                        umbitems_tipos_usuario t
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND t.ID_TIPO_USU = u.ID_TIPO_USU
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ASIGNADOS,
                        (
                        SELECT GROUP_CONCAT(CONCAT('- ',u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS,'<br>') SEPARATOR '</strong><br>') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u,
                        umbitems_tipos_usuario t
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND t.ID_TIPO_USU = u.ID_TIPO_USU
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        AND u.ID_TIPO_USU=2
                        )
                        ASIGNADOS_CONSTRUCCION,
                        (
                        SELECT COUNT(p.PREGUNTA_ID) FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        ITEMS,
                        (
                        SELECT COUNT(p.PREGUNTA_ID) FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_DIAGRAMADA = 1
                        )
                        DIAGRA,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELRUBRICA   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELRUBRICAS,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELDIFICULTAD   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELDIFICULTAD,

                        (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=1 AND p.PREGUNTA_ESTADO=1 
                        ) TOTAL_SU,
                        (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=2 AND p.PREGUNTA_ESTADO=1 
                        ) TOTAL_UB,
                        (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=3 AND p.PREGUNTA_ESTADO=1 
                        ) TOTAL_RE,
                        (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=4 AND p.PREGUNTA_ESTADO=1 
                        ) TOTAL_SI,
                        (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=5 AND p.PREGUNTA_ESTADO=1 
                        ) TOTAL_SE

                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        COMPONENTE_ESTADO = '1' ";
        //echo $SQL_string;  
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_est($COMPONENTE_ID) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,
                        (
                        SELECT GROUP_CONCAT(CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS,': <strong>',t.NOM_TIPO_USU) SEPARATOR '</strong><br>') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u,
                        umbitems_tipos_usuario t
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND t.ID_TIPO_USU = u.ID_TIPO_USU
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ASIGNADOS,
                        (
                        SELECT COUNT(p.PREGUNTA_ID) FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        ITEMS,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELRUBRICA   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELRUBRICAS,
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELDIFICULTAD   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        AND p.PREGUNTA_ESTADO = 1
                        )
                        NIVELDIFICULTAD                  
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        COMPONENTE_ESTADO = '1' 
                        AND COMPONENTE_ID = '$COMPONENTE_ID' ";
        //echo $SQL_string;  
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_component_id($COMPONENTE_ID) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,
                        (
                        SELECT GROUP_CONCAT(u.USUARIO_ID SEPARATOR ',') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ASIGNADOS       
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        c.COMPONENTE_ESTADO = '1' 
                        AND c.COMPONENTE_ID = $COMPONENTE_ID ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_value($sigla) {
        $CI = & get_instance();
        $SQL_string = "SELECT *
                      FROM 
                        {$this->db->dbprefix('componentes')} c  
                      WHERE 
                        COMPONENTE_ESTADO = '1' 
                        AND COMPONENTE_SIGLA='$sigla' ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user($id_user) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.COMPONENTE_ID, 
                        CONCAT( 
                            c.COMPONENTE_NOMBRE, 
                            ' - ', 
                            c.COMPONENTE_SIGLA ,
                            ' - ITEMS ELABORADOS A LA FECHA:',
                            (
                                SELECT COUNT(PREGUNTA_ID)
                                FROM {$this->db->dbprefix('preguntas')} p
                                WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                                AND p.PREGUNTA_ESTADO = 1
                            )
                        ) COMPONENTE_NOMBRE
                      FROM 
                        {$this->db->dbprefix('componentes')} c,
                        {$this->db->dbprefix('usuarios_componentes')} uc,
                        {$this->db->dbprefix('usuarios')} u    
                      WHERE 
                        c.COMPONENTE_ID = uc.COMPONENTE_ID
                        AND
                        uc.USUARIO_ID = u.USUARIO_ID
                        AND
                        u.USUARIO_ID = $id_user
                        AND
                        c.COMPONENTE_ESTADO = '1'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user_2($id_user) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,uc.*,u.*,
                            (
                            SELECT COUNT(PREGUNTA_ID)
                            FROM {$this->db->dbprefix('preguntas')} p
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND p.PREGUNTA_ESTADO = 1
                            ) TOTAL,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=4
                            ) TOTAL_VALIDADO,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=1
                            ) TOTAL_VALIDADO2  ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA1_OK=1
                            ) VALIDA1 ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA2_OK=1
                            ) VALIDA2 ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_SELECCIONADA=1
                            ) TOTAL_SELECCIONADOS ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_DIAGRAMADA=1
                            ) PREGUNTA_DIAGRAMADA          
                      FROM 
                        {$this->db->dbprefix('componentes')} c,
                        {$this->db->dbprefix('usuarios_componentes')} uc,
                        {$this->db->dbprefix('usuarios')} u    
                      WHERE 
                        c.COMPONENTE_ID = uc.COMPONENTE_ID
                        AND
                        uc.USUARIO_ID = u.USUARIO_ID
                        AND
                        u.USUARIO_ID = $id_user
                        AND
                        c.COMPONENTE_ESTADO = '1' ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user_3($id_user) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,uc.*,u.*,
                            (
                            SELECT COUNT(PREGUNTA_ID)
                            FROM {$this->db->dbprefix('preguntas')} p
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            ) TOTAL,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=4
                            ) TOTAL_VALIDADO,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=1
                            ) TOTAL_VALIDADO2  ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA1_OK=1
                            ) VALIDA1 ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA2_OK=1
                            ) VALIDA2 ,                            
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_SELECCIONADA=1
                            ) TOTAL_SELECCIONADOS,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_DIAGRAMADA=1
                            ) PREGUNTA_DIAGRAMADA                             
                      FROM 
                        {$this->db->dbprefix('componentes')} c,
                        {$this->db->dbprefix('usuarios_componentes')} uc,
                        {$this->db->dbprefix('usuarios')} u    
                      WHERE 
                        c.COMPONENTE_ID = uc.COMPONENTE_ID
                        AND
                        uc.USUARIO_ID = u.USUARIO_ID
                        AND
                        u.USUARIO_ID = $id_user
                        AND
                        c.COMPONENTE_ESTADO = '1' 
                        
                        ORDER BY c.COMPONENTE_SIGLA";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user_4($id_user) {
        $CI = & get_instance();

        $SQL_string = "SELECT c.*,uc.*,u.*,
                            (
                            SELECT COUNT(PREGUNTA_ID)
                            FROM {$this->db->dbprefix('preguntas')} p
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            ) TOTAL,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=4
                            ) TOTAL_VALIDADO,
                            (
                            SELECT COUNT(e.PREGUNTA_ID)
                            FROM {$this->db->dbprefix('evaluacion')} e,
                            {$this->db->dbprefix('preguntas')} p   
                            WHERE p.COMPONENTE_ID = c.COMPONENTE_ID 
                            AND e.PREGUNTA_ID = p.PREGUNTA_ID
                            AND p.PREGUNTA_ESTADO = 1 AND p.PREGUNTA_ETAPA !=0
                            AND TIPOEVALUACION_ID=1
                            ) TOTAL_VALIDADO2,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA1_OK=1
                            ) VALIDA1 ,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_VALIDA2_OK=1
                            ) VALIDA2 ,                            
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_SELECCIONADA=1
                            ) TOTAL_SELECCIONADOS,
                            (
                            SELECT COUNT(p.PREGUNTA_ID)
                            FROM
                            {$this->db->dbprefix('preguntas')} p
                            WHERE 
                            p.COMPONENTE_ID = c.COMPONENTE_ID
                            AND p.PREGUNTA_ESTADO = 1 
                            AND p.PREGUNTA_ETAPA !=0
                            AND p.PREGUNTA_DIAGRAMADA=1
                            ) PREGUNTA_DIAGRAMADA                            
                      FROM 
                        {$this->db->dbprefix('componentes')} c,
                        {$this->db->dbprefix('usuarios_componentes')} uc,
                        {$this->db->dbprefix('usuarios')} u    
                      WHERE 
                        c.COMPONENTE_ID = uc.COMPONENTE_ID
                        AND
                        uc.USUARIO_ID = u.USUARIO_ID
                        AND
                        u.USUARIO_ID = $id_user
                        AND
                        c.COMPONENTE_ESTADO = '1' 
                        
                        ORDER BY c.COMPONENTE_SIGLA";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id($id_component) {
        $CI = & get_instance();
        $SQL_string = "SELECT c.*,
                                (
                                SELECT COUNT(PREGUNTA_ID)
                                FROM {$this->db->dbprefix('preguntas')} p
                                WHERE
                                p.COMPONENTE_ID = c.COMPONENTE_ID
                                AND p.PREGUNTA_ESTADO = 1
                                )
                                as TOTAL_ITEMS                   
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        c.COMPONENTE_ID = $id_component
                        AND
                        c.COMPONENTE_ESTADO = '1' ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user_id_component($id_user, $id_component) {
        $where = '';
        if ($id_component == 'ALL') {
            $where = '';
        } else {
            $where = " AND COMPONENTE_ID = $id_component";
        }
        $SQL_string = "SELECT *
                      FROM 
                        {$this->db->dbprefix('usuarios_componentes')} 
                      WHERE 
                        USUARIO_ID = $id_user
                        $where
                        ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_componentslevels_id_user_id_component($id_user, $id_component, $ID_TIPO_USU) {
        $where = '';
        if($ID_TIPO_USU == 1){
           $where.= "AND `USUARIO_ID` = $id_user"; 
        }
        $SQL_string = "SELECT `PREGUNTA_NIVELPREGUNTA`,
                        CONCAT(PREGUNTA_NIVELPREGUNTA,' ',COUNT(`PREGUNTA_ID`)) TOTAL
                        FROM `umbitems_preguntas` 
                        WHERE `COMPONENTE_ID` = $id_component AND `PREGUNTA_ESTADO`=1 $where
                        GROUP BY `PREGUNTA_NIVELPREGUNTA`";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_component($data) {
        $CI = & get_instance();
        $SQL_string = "INSERT IGNORE  INTO {$this->db->dbprefix('componentes')}
                      (
                       COMPONENTE_NOMBRE,  
                       COMPONENTE_SIGLA,     
                       COMPONENTE_ESTADO,
                       COMPONENTE_PREGUNTAS
                       )
                      VALUES 
                       (
                       '{$data['COMPONENTE_NOMBRE']}',"
                    . "'{$data['COMPONENTE_SIGLA']}',"
                    . "'{$data['COMPONENTE_ESTADO']}',"
                    . "'{$data['COMPONENTE_PREGUNTAS']}'
                       )
                       ";
        if ($this->db->query($SQL_string)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function insert_component_users($data, $COMPONENTE_ID) {

        //echo print_r($data['USUARIO_IDs'],true);
        if (count($data['USUARIO_IDs']) > 0) {
            $this->db->query("DELETE FROM {$this->db->dbprefix('usuarios_componentes')} WHERE COMPONENTE_ID = '{$COMPONENTE_ID}' ");
            for ($a = 0; $a < count($data['USUARIO_IDs']); $a++) {
                if ($data['USUARIO_IDs'][$a] > 0) {
                    $SQL_string_2 = "INSERT INTO {$this->db->dbprefix('usuarios_componentes')}
                                        (
                                         COMPONENTE_ID,  
                                         USUARIO_ID
                                         )
                                        VALUES 
                                         (
                                         '{$COMPONENTE_ID}','" . $data['USUARIO_IDs'][$a] . "'
                                         );
                                         ";
                    $this->db->query($SQL_string_2);
                }
            }
        }
    }

    public function update_component($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('componentes')} SET
                       COMPONENTE_NOMBRE = '{$data['COMPONENTE_NOMBRE']}', 
                       COMPONENTE_SIGLA = '{$data['COMPONENTE_SIGLA']}',  
                       COMPONENTE_ESTADO = '{$data['COMPONENTE_ESTADO']}',
                       COMPONENTE_PREGUNTAS= '{$data['COMPONENTE_PREGUNTAS']}'
                       WHERE
                       COMPONENTE_ID = {$data['COMPONENTE_ID']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_component_vobo($data) {
        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('componentes')} SET
                       COMPONENTE_OKCONSTRUCTOR = '{$data['COMPONENTE_OKCONSTRUCTOR']}',
                       COMPONENTE_OKCONSTRUCTOR_FECHA = '{$data['COMPONENTE_OKCONSTRUCTOR_FECHA']}',
                       COMPONENTE_OKCONSTRUCTOR_ID = '{$data['COMPONENTE_OKCONSTRUCTOR_ID']}'
                       WHERE
                       COMPONENTE_ID = {$data['COMPONENTE_ID']}
                       ";
        $return = $SQL_string_query = $this->db->query($SQL_string);

        return $return;
    }

}
