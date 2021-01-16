<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\basic_test\Controller\BasicTestController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\basic_test\Controller;

class BasicTestController
{

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function hola_mundo()
    {
        return [
            '#theme' => 'basic_test_theme_test'
        ];
    }

    public function insercion(){

        $database = \Drupal::database();
        $nombre = $_GET['fname'];
        $apellido = $_GET['lname'];
        $query = "INSERT INTO inserts (`nombre`, `apellido`) VALUES ('$nombre', '$apellido');";
        $database->query($query);

        
        $array_vars = [];
        $array_vars['nombre'] = $nombre;
        $array_vars['apellido'] = $apellido;
        return [
            '#theme' => 'success_insert_twig',
            '#vars' => $array_vars
        ];
    
    }

    public function get_inserts(){
        $database = \Drupal::database();
        $query = "SELECT * FROM inserts;";
        $listado = $database->query($query)->fetchAll();

        return[
            '#theme' => 'list_page',
            '#vars' => $listado
        ];
    }



}
