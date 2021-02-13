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
        if (isset($_REQUEST['usuario'])) {
            $usuario = $_REQUEST['usuario'];
        } else {
            $fail_request = "fail_3";
        }
        if (isset($_REQUEST['email'])) {
            $email =  $_REQUEST['email'];
        } else {
            $fail_request = "fail_4";
        }


        if (empty($fail_request)) {
            if(!empty($_POST["nombre"])) {
                $query = "SELECT * FROM ajax_inserts WHERE usuario='" . $_POST["usuario"] . "'";
                $user_count = $database->query($query)->fetch();
                $query_email = "SELECT * FROM ajax_inserts WHERE email='" . $_POST["email"] . "'";
                $email_count = $database->query($query_email)->fetch();
                if($user_count || $email_count >0) {
                    $fail="fatalerror";
                    print_r($fail);
                   
                }else{
                    $query_insert = "INSERT INTO ajax_inserts (`nombre`, `apellido`, `usuario`,`email`) VALUES ('$nombre', '$apellido', '$usuario', '$email');";
                    $database->query($query_insert);
                }
              }
        }

        $database = \Drupal::database();

        $query_get = "SELECT * FROM drupal8.ajax_inserts;";
        $list = $database->query($query_get)->fetchAll();

        return new JsonResponse([
            'data' => $list,
            'method' => 'GET',
        ]);
// tengo que meter todo en un controler y usar el json response para en viar la data al ajax y desde ahi poder procesarla, sacar el redirectresponse, y coopiar el codigo  del js, tambien editar el tiwg
        
    }




}
