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
        if (isset($_GET['nacimiento']) && $_GET['nacimiento'] != '') {
            $nacimiento = $_GET['nacimiento'];
        } else {
            $errores[] = "El campo Nacimiento es requerido";
        }
        if (isset($_GET['dni']) && $_GET['dni'] != '') {
            $dni = $_GET['dni'];
        } else {
            $errores[] = "El campo D.N.I es requerido";
        }
        if (isset($_GET['cuit']) && $_GET['cuit'] != '') {
            $cuit = $_GET['cuit'];
        } else {
            $errores[] = "El campo Numero de CUIT es requerido";
        }
        if (isset($_GET['estado_civil']) && $_GET['estado_civil'] != '') {
            $estado_civil = $_GET['estado_civil'];
        } else {
            $errores[] = "El campo Estado Civil es requerido";
        }
        if (isset($_GET['hijos']) && $_GET['hijos'] != '') {
            $hijos = $_GET['hijos'];
        } else {
            $errores[] = "El campo Hijos es requerido";
        }
        if (isset($_GET['genero']) && $_GET['genero'] != '') {
            $genero = $_GET['genero'];
        } else {
            $errores[] = "El campo Genero es requerido";
        }
        if (isset($_GET['pais']) && $_GET['pais'] != '') {
            $pais = $_GET['pais'];
        } else {
            $errores[] = "El campo Pais es requerido";
        }
        if (isset($_GET['provincia']) && $_GET['provincia'] != '') {
            $provincia = $_GET['provincia'];
        } else {
            $errores[] = "El campo Provincia es requerido";
        }
        if (isset($_GET['localidad']) && $_GET['localidad'] != '') {
            $localidad = $_GET['localidad'];
        } else {
            $errores[] = "El campo Localidad es requerido";
        }
        if (isset($_GET['calle']) && $_GET['calle'] != '') {
            $calle = $_GET['calle'];
        } else {
            $errores[] = "El campo Calle es requerido";
        }
        if (isset($_GET['numero']) && $_GET['numero'] != '') {
            $numero = $_GET['numero'];
        } else {
            $errores[] = "El campo Numero es requerido";
        }
        if (isset($_GET['piso']) && $_GET['piso'] != '') {
            $piso = $_GET['piso'];
        } else {
            $errores[] = "El campo Piso es requerido";
        }
        if (isset($_GET['codigo_postal']) && $_GET['codigo_postal'] != '') {
            $codigo_postal = $_GET['codigo_postal'];
        } else {
            $errores[] = "El campo Codigo Postal es requerido";
        }
        if (isset($_GET['email']) && $_GET['email'] != '') {
            $email = $_GET['email'];
        } else {
            $errores[] = "El campo Direccion de Email es requerido";
        }
        if (isset($_GET['telefono_celular']) && $_GET['telefono_celular'] != '') {
            $telefono_celular = $_GET['telefono_celular'];
        } else {
            $errores[] = "El campo Numero de Celular es requerido";
        }
        if (isset($_GET['telefono_fijo']) && $_GET['telefono_fijo'] != '') {
            $telefono_fijo = $_GET['telefono_fijo'];
        } else {
            $errores[] = "El campo Numero de Telefono Fijo es requerido";
        }


        if (!empty($errores)) {
            foreach ($errores as $error) {
                \Drupal::messenger()->addMessage(($error), 'error');
            }
            return new RedirectResponse(\Drupal::url('basic_test.add_new'));
        }

        $query = "INSERT INTO inserts (`nombre`, `apellido`, `nacimiento`, `dni`, `cuit`, `estado_civil`, `hijos`, `genero`, `pais`, `provincia`, `localidad`, `calle` ,`numero`, `piso`, `codigo_postal`, `email`, `telefono_celular`, `telefono_fijo`) 
        VALUES ('$nombre', '$apellido', '$nacimiento', '$dni', '$cuit', '$estado_civil', '$hijos', '$genero', '$pais', '$provincia', '$localidad', '$calle', '$numero', '$piso', '$codigo_postal', '$email', '$telefono_celular', '$telefono_fijo');";
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
}
