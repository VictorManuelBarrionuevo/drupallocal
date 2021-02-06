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

        $query_get = "SELECT * FROM drupal8.ajax_inserts;";
        $list = $database->query($query_get)->fetchAll();

        return [
            '#theme' => 'form_ajax',
            '#vars' => $list
        ];
    }

    public function save_new_form()
     {
         $fail_request = [];
        $database = \Drupal::database();

        if (isset($_REQUEST['nombre'])) {
            $nombre = $_REQUEST['nombre'];
        } else {
            $fail_request = "fail_1";
        }
        if (isset($_REQUEST['apellido'])) {
            $apellido =  $_REQUEST['apellido'];
        } else {
            $fail_request = "fail_2";
        }


        if (empty($fail_request)) {
            $query_insert = "INSERT INTO ajax_inserts (`nombre`, `apellido`) VALUES ('$nombre', '$apellido');";
            $database->query($query_insert);
            
        }

        return new RedirectResponse(\Drupal::url('form_ajax.add_new_form'));
    }




}
