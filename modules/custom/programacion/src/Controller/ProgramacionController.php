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

        if(isset($_GET['materia_id'])){
            $materia_id = $_GET['materia_id'];
        } else {
            $materia_id = 1;
        }

        /*print_r('<PRE>');
        print_r($materias);
        print_r('</PRE>');
        die();*/
        /*en el isset, vamos a comprobar que la variable que traiga get sea grado, en caso de ser asi, 
        lr vamos a igualar la variable grado a ;get(grado), seria definir como una variable existente o null
        en caso de no existir esa igualacion de variable en el get, se le asigna el uno(else) para que la variable exista;*/

        $query = "select a.nombre, 
                a.apellido, 
                a.materias as materias_ids, 
                a.maestro_id,
                a.grado
                from alumno a
                inner join maestro m on a.maestro_id = m.id ";

        if(isset($_GET['grado'])){
            $grado = $_GET['grado'];
            $query .= " and grado = $grado";
        }

        if(isset($_GET['maestro_id'])){
            $maestro_id = $_GET['maestro_id'];
            $query .= " and maestro_id = $maestro_id";
        }

        $alumnos = $database->query($query)->fetchAll();
      
            /*print_r('<PRE>');
            print_r($alumno->maestro_id);
            print_r('</PRE>');
            die();*/
       
       
        foreach ($alumnos as $alumno) {
            $maestro_id = $alumno->maestro_id;
            $maesQuery = "SELECT nombre, apellido FROM maestro where id= $maestro_id;";
            $nombre_maestro = $database->query($maesQuery)->fetchAll();
            $alumno->maestro = $nombre_maestro[0]->apellido . ' ' .$nombre_maestro[0]->nombre ;
            /*print_r('<PRE>');
            print_r($nombre_maestro[0]->apellido . ' ' .$nombre_maestro[0]->nombre);
            print_r('</PRE>');
            die();*/
        }



        foreach ($alumnos as $alumno) {
            $materias_ids = $alumno->materias_ids;
            $idsEx = explode(',', $materias_ids);
            foreach ($idsEx as $idEx) {
                $matQuery = "SELECT nombre FROM materias where id = $idEx;";
                $nombre_materia = $database->query($matQuery)->fetchAll();
                $alumno->materias[] = $nombre_materia[0]->nombre;
            }
        }

        $num_random = rand(5, 15);
        $array_vars = [];
        $array_vars['num_random'] = $num_random;
        $array_vars['alumnos'] = $alumnos;
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
        print_r('nuevo valor: ');
        print_r($text);
        $db->query("UPDATE `drupaldb`.`programacion` SET `programacion_value` = '$text' WHERE (`id` = '4');")->execute();
    }
}
