<?php

/**
 * @file
 * @author Rakesh James
 * Contains \Drupal\example\Controller\ExampleController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\programacion\Controller;

/**
 * Provides route responses for the Example module.
 */
class ProgramacionController
{
    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function test1()
    {
        $database = \Drupal::database();

        // BUSCAR LISTADO DE MAESTROS
        $query_maestros = "SELECT nombre, apellido, id FROM maestro;";
        $maestros = $database->query($query_maestros)->fetchAll();

        $query_grados = "SELECT distinct(grado) FROM alumno order by grado ASC;";
        $grados = $database->query($query_grados)->fetchAll();
        
        // BUSCAR LISTADO DE MATERIAS
        $query_materias = "SELECT nombre, id FROM materias;";
        $materias = $database->query($query_materias)->fetchAll();

 

        /*print_r('<PRE>');
        print_r($materias);
        print_r('</PRE>');
        die();*/

        
        if(isset($_GET['grado'])){
            $grado = $_GET['grado'];
        } else {
            $grado = 1;
        }
        if(isset($_GET['maestro_id'])){
            $maestro_id = $_GET['maestro_id'];
        } else {
            $maestro_id = 1;
        }
        if(isset($_GET['materia_id'])){
            $materia_id = $_GET['materia_id'];
        } else {
            $materia_id = 1;
        }
        $query = "select a.nombre, a.apellido from alumno a
                inner join maestro m on a.maestro_id = m.id
                where grado = $grado
                and maestro_id = $maestro_id;";

        $alumnos = $database->query($query)->fetchAll();

        

        foreach ($alumnos as $alumno) {
             $alumnos_a_mostrar[] = $alumno->nombre . ' ' . $alumno->apellido;
        }
        $num_random = rand(5, 15);
        $array_vars = [];
        $array_vars['num_random'] = $num_random;
        $array_vars['alumnos'] = $alumnos_a_mostrar;
        $array_vars['maestros'] = $maestros;
        $array_vars['grados'] = $grados;
        $array_vars['materias'] = $materias;
        $array_vars['grado_selected'] = $grado;
        $array_vars['maestro_selected'] = $maestro_id;
        $array_vars['materia_selected'] = $materia_id;
        

        return [
            '#theme' => 'theme_test1',
            '#array_vars' => $array_vars
        ];
    }

    public function guardartexto()
    {
        $db = \Drupal::database();
        $text = $_POST['inputtexto'];

        /*$db->update('programacion')->condition('id' , '4')
        ->updateFields([
            'programacion_value' => $text
        ])
        ->execute();*/






        print_r('nuevo valor: ');
        print_r($text);
        //die();




        $db->query("UPDATE `drupaldb`.`programacion` SET `programacion_value` = '$text' WHERE (`id` = '4');")->execute();
    }


}
