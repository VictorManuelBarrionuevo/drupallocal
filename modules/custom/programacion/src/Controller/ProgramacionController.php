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
        $result = $database->query("SELECT programacion_value FROM programacion where id = 2")->fetch();
        $color = $result->programacion_value;
        
        $num_random = rand(5, 15);

        $array_vars = [];
        $array_vars['num_random'] = $num_random;
        $array_vars['color'] = $color;

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
