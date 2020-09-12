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
        $result = $database->query("SELECT programacion_value FROM programacion where id = 5")->fetch();
        $color = $result->programacion_value;

        $num_random = rand(5, 15);
        return [
            '#theme' => 'test1',
            '#test_var' => $num_random,
            '#color' => $color
        ];
    }
}
