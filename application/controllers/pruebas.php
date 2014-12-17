<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pruebas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pruebas_model');
    }

    public function asignar() {
        $institutos = $this->pruebas_model->get_institutos();
        //echo '<pre>'.print_r($institutos,true).'</pre>';

        $espacios = $this->pruebas_model->get_espacios();
        //echo '<pre>'.print_r($espacios,true).'</pre>';

        $array_espacios = array();

        $contador = 1;
        foreach ($espacios as $espacio) {
            for ($a = 1; $a <= $espacio->espacio_capacidad; $a++) {
                $array_espacios[$contador]['No'] = $contador;
                $array_espacios[$contador]['institucion_id'] = $espacio->institucion_id;
                $array_espacios[$contador]['espacio_id'] = $espacio->espacio_id;
                $array_espacios[$contador]['institucion_nombre'] = $espacio->institucion_nombre;
                $array_espacios[$contador]['espacio_aula'] = $espacio->espacio_aula;
                $array_espacios[$contador]['espacio_bloque'] = $espacio->espacio_bloque;
                $array_espacios[$contador]['espacio_piso'] = $espacio->espacio_piso;
                $array_espacios[$contador]['espacio_direccion'] = $espacio->espacio_direccion;
                $array_espacios[$contador]['puesto'] = $a;
                $contador++;
            }
        }

        shuffle($array_espacios);
        /*
        echo '<pre>'.print_r($array_espacios,true).'</pre>';
        //----------------------------------------------------//----------------------------------------------------//

        $inscritos = $this->pruebas_model->get_inscritos();
        
        //echo '<pre>'.print_r($inscritos,true).'</pre>';
        
        $array_inscrito_espacio = array();

        $contador = 0;
        foreach ($inscritos as $inscrito) {
            $array_inscrito_espacio[$contador + 1]['espacio_id'] = $array_espacios[$contador]['espacio_id'];
            $array_inscrito_espacio[$contador + 1]['institucion_nombre'] = $array_espacios[$contador]['institucion_nombre'];
            $array_inscrito_espacio[$contador + 1]['espacio_aula'] = $array_espacios[$contador]['espacio_aula'];
            $array_inscrito_espacio[$contador + 1]['espacio_bloque'] = $array_espacios[$contador]['espacio_bloque'];
            $array_inscrito_espacio[$contador + 1]['espacio_piso'] = $array_espacios[$contador]['espacio_piso'];
            $array_inscrito_espacio[$contador + 1]['espacio_direccion'] = $array_espacios[$contador]['espacio_direccion'];
            $array_inscrito_espacio[$contador + 1]['puesto'] = $array_espacios[$contador]['puesto'];
            $array_inscrito_espacio[$contador + 1]['inscrito_cedula'] = $inscrito->inscrito_cedula;
            $array_inscrito_espacio[$contador + 1]['inscrito_nombre'] = $inscrito->inscrito_nombre;
            $array_inscrito_espacio[$contador + 1]['inscrito_pin'] = $inscrito->inscrito_pin;
            $array_inscrito_espacio[$contador + 1]['inscrito_id'] = $inscrito->inscrito_id;
            $contador++;
        }
        
        //echo '<pre>'.print_r($array_inscrito_espacio,true).'</pre>';
        echo "INSERT INTO umbpruebas_inscritos (inscrito_pin,inscrito_cedula,inscrito_nombre,espacio_id,puesto) VALUES <br>";
        foreach ($array_inscrito_espacio as $data){
            //echo '<pre>'.print_r($data,true).'</pre>';
            $this->pruebas_model->asignar($data);
         }*/
    }

    public function vista() {
        $inscritos = $this->pruebas_model->get_inscritos_asignados();

        if(count($inscritos)>0) {

            //header("Content-type: application/octet-stream; charset=UTF-8");
            //header("Content-Disposition: attachment; filename=pruebas.xls");
            header('Content-Type: text/html; charset=UTF-8');
            header("Pragma: no-cache");
            header("Expires: 0");
            ?>
            <table>
                <tr>
                    <td>No.</td>
                    <td>ID</td>
                    <td>INSTITUTO</td>
                    <td>AULA</td>
                    <td>BLOQUE</td>
                    <td>PISO</td>
                    <td>DIRECCION</td>
                    <td>PUESTO</td>
                    <td>CEDULA</td>
                </tr>
                <?php
                $a = 1;
                foreach ($inscritos as $inscrito) {
                    ?>
                    <tr>
                        <td><?php echo $a ?></td>
                        <td><?php echo $inscrito->espacio_id; ?></td>
                        <td><?php echo $inscrito->institucion_nombre; ?></td>
                        <td><?php echo $inscrito->espacio_aula; ?></td>
                        <td><?php echo $inscrito->espacio_bloque; ?></td>
                        <td><?php echo $inscrito->espacio_piso; ?></td>
                        <td><?php echo $inscrito->espacio_direccion; ?></td>
                        <td><?php echo $inscrito->puesto; ?></td>
                        <td><?php echo $inscrito->inscrito_cedula; ?></td>
                    </tr>                    
                    <?php
                    $a++;
                }
                ?>
            </table>
            <?php
        }else{
            echo "Sin Asignados";
        }
    }

}
