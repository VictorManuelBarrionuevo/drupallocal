<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\form_ajax\Controller\FormAjaxController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\form_ajax\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FormAjaxController
{

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function add_new_form()
    {
        $database = \Drupal::database();

        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];

        $query_insert = "INSERT INTO ajax_inserts (`nombre`, `apellido`) VALUES ('$nombre', '$apellido');";
        $database->query($query_insert);

        $query_get = "SELECT * FROM drupal8.ajax_inserts;";
        $list = $database->query($query_get)->fetchAll();
        /*$vars = [];
        $vars["nombre"] = $nombre;
        $vars["apellido"] = $apellido;
      
        $vars = $_REQUEST["nombre"]." ".$_REQUEST["apellido"];*/
        return [
            '#theme' => 'form_ajax',
            '#vars' => $list
        ];
    }
}
