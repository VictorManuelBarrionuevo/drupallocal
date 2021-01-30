<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\basic_test\Controller\BasicTestController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\basic_test\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

class BasicTestController
{

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function add_new()
    {
        return [
            '#theme' => 'basic_test_theme_test'
        ];
    }

    public function insercion()
    {
        if (empty($_GET)) {
            return new RedirectResponse(\Drupal::url('basic_test.add_new'));
        }

        $errores = [];
        $database = \Drupal::database();

        if (isset($_GET['nombre'])) {
            $nombre = $_GET['nombre'];
        } else {
            $errores[] = "El campo Nombre es requerido";
        }
        if (isset($_GET['apellido'])) {
            $apellido = $_GET['apellido'];
        } else {
            $errores[] = "El campo Apellido es requerido";
        }

        if (!empty($errores)) {
            foreach ($errores as $error) {
                \Drupal::messenger()->addMessage(($error), 'error');
            }
            return new RedirectResponse(\Drupal::url('basic_test.add_new'));
        }

        $query = "INSERT INTO inserts (`nombre`, `apellido`) VALUES ('$nombre', '$apellido');";
        $database->query($query);

        $texto = "El usuario $nombre $apellido se ha registrado.";
        \Drupal::messenger()->addMessage(($texto), 'status');
        return new RedirectResponse(\Drupal::url('basic_test.list_inserts'));
    }

    public function get_inserts()
    {
        $database = \Drupal::database();
        $query_count = "select COUNT(*) as amount FROM inserts;";
        $cantidad_inserts = $database->query($query_count)->fetch();
        $amount = $cantidad_inserts->amount;

        $cant_paginas = intval((int)$amount / 10) + 1;

        $pages = [];
        for ($i = 1; $i < $cant_paginas + 1; $i++) {
            $pages[] = $i;
        }

        $pagina_requerida = $_GET["page"];
        $offset = ((int)$pagina_requerida ) * 10;
        /*print('<pre>');
        print_r($offset);
        print('</pre>');
        die();*/

        $query = "SELECT * FROM drupal8.inserts limit 10 offset $offset;";
        $listado = $database->query($query)->fetchAll();
        /*print('<pre>');
        print_r($listado);
        print('</pre>');
        die();*/
        $vars = [];
        $vars['listado'] = $listado;
        $vars['pages'] = $pages;


        return [
            '#theme' => 'list_page',
            '#vars' => $vars
        ];
    }
}
