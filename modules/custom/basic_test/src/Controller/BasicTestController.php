<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\basic_test\Controller\BasicTestController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\basic_test\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
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
        //buscar en la base todos los registros de pais
        $database = \Drupal::database();
        $query_pais = "SELECT * FROM paises";
        $paises = $database->query($query_pais)->fetchAll();
        $vars['paises'] = $paises;
        return [
            '#theme' => 'basic_test_theme_test',
            '#vars' => $vars
        ];
    }

    public function insercion()
    {
        if (empty($_GET)) {
            return new RedirectResponse(\Drupal::url('basic_test.add_new'));
        }

        $errores = [];
        $database = \Drupal::database();

        if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
            $nombre = $_GET['nombre'];
        } else {
            $errores[] = "El campo Nombre es requerido";
        }
        if (isset($_GET['apellido']) && $_GET['apellido'] != '') {
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

        if (isset($_GET["page"])) {
            $pagina_requerida = $_GET["page"];
        } else {
            $pagina_requerida = 1;
        }

        $offset = ((int)$pagina_requerida - 1) * 10;

        $query = "SELECT * FROM inserts limit 10 offset $offset;";
        $listado = $database->query($query)->fetchAll();
        $vars = [];
        $vars['listado'] = $listado;
        $vars['pages'] = $pages;

        return [
            '#theme' => 'list_page',
            '#vars' => $vars
        ];
    }

    public function get_provincias($id_pais)
    {
        //buscar en la base las provincias que tengan el id_pais = $id_pais
        $database = \Drupal::database();
        $query_provincias = "SELECT * FROM provincias WHERE id_pais = $id_pais";
        $provincias = $database->query($query_provincias)->fetchAll();
        return new JsonResponse([
            'data' => $provincias,
            'method' => 'GET',
        ]);
    }

    public function delete_users($id){
        //recibir un id del usuario que quiero borrar
        //ir a la base de datos y borrarlo
        $database = \Drupal::database();
        $query_delete = "DELETE FROM inserts WHERE id = $id";
        $database->query($query_delete);
        //responder con el mensaje que todo salio ok
        //tenemos que olver a la pagina que ya estaba y mostrar el mensaje



    }
}
