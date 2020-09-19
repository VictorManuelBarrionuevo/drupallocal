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
        if(isset($_GET['grado'])){
            $grado = $_GET['grado'];
        } else {
            $grado = 1;
        }
        if(isset($_GET['grado'])){
            $maestro_id = $_GET['maestro_id'];
        } else {
            $maestro_id = 1;
        }
        
        $query = "select a.nombre, a.apellido from alumno a
                inner join maestro m on a.maestro_id = m.id
                where grado = $grado
                and maestro_id = $maestro_id;";

        $alumnos = $database->query($query)->fetchAll();

        

        foreach ($alumnos as $alumno) {
             $alumnos_a_mostrar[] = $alumno->nombre . ' ' . $alumno->apellido;
        }
        /*print_r('<PRE>');
        print_r($alumnos_a_mostrar);
        print_r('<PRE>');
        die();*/
        
        $num_random = rand(5, 15);

        $array_vars = [];
        $array_vars['num_random'] = $num_random;
        $array_vars['alumnos'] = $alumnos_a_mostrar;

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
