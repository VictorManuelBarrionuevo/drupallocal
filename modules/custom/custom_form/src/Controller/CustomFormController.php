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
        $database = \Drupal::database();

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nacimiento = $_POST['nacimiento'];
        $dni = $_POST['dni'];
        $cuit = $_POST['cuit'];
        $estado_civil = $_POST['estado_civil'];
        if ($estado_civil == 'casado') {
            $est_civil = 1;
        } else {
            $est_civil = 0;
        }
        $hijos = $_POST['hijos'];

        $pais = $_POST['pais'];

        $query_to_insert = "INSERT INTO `forms` (`nombre`, `apellido`, `nacimiento`, `dni`, `cuit`, `estado_civil`, `hijos`, `id_pais`) 
            VALUES ('$nombre', '$apellido', '$nacimiento', '$dni', '$cuit', '$est_civil', '$hijos', '$pais');";
        $database->query($query_to_insert);

        $query_get_list = " SELECT f.id, f.nombre, f.apellido, f.nacimiento, f.dni, f.cuit, f. estado_civil, f.hijos, p.name as pais
                            FROM forms f
                            inner join paises p on f.id_pais = p.id;";

        $form_list = $database->query($query_get_list)->fetchAll();

        $array_vars  = [];
        $array_vars['nombre'] = $nombre;
        $array_vars['apellido'] = $apellido;
        $array_vars['nacimiento'] = $nacimiento;
        $array_vars['dni'] = $dni;
        $array_vars['cuit'] = $cuit;
        $array_vars['estado_civil'] = $estado_civil;
        $array_vars['hijos'] = $hijos;
        $array_vars['pais'] = $pais;

        /*print_r('<PRE>');
        print_r($array_vars['nombre']);
        print_r('</PRE>');
        die();*/


        return [
            '#theme' => 'custom_form_list',
            '#variables' => $form_list,
            '#variables' => $array_vars,



        ];
    }
}
