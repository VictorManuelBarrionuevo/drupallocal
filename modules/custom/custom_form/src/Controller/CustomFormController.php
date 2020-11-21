<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\custom_form\Controller\CustomFormController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\custom_form\Controller;

class CustomFormController
{

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function add_new()
    {
        $database = \Drupal::database();

        // BUSCAR LISTADO DE PROVINCIAS Y PAISES
        $query_pais_prov = "SELECT pa.id as pais_id, pa.name as pais_name, pr.id as provincia_id, pr.name as provincia_name 
                            FROM provincias pr
                            inner join paises pa 
                            on pa.id = pr.id_pais;";
        $pais_prov = $database->query($query_pais_prov)->fetchAll();
        $variables = [];
        $variables['pais_prov'] = $pais_prov;

        return [
            '#theme' => 'custom_form',
            '#variables' => $variables
        ];
        
    }
    public function save_new()
    {
        print_r("<pre>");
        print_r($_POST['pais']);
        print_r("</pre>");
    }
}
