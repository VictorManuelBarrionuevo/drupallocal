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
        if (isset($_GET['nacimiento'])) {
            $nacimiento = $_GET['nacimiento'];
        } else {
            $errores[] = "El campo nacimiento es requerido";
        }
        if (isset($_GET['dni'])) {
            $dni = $_GET['dni'];
        } else {
            $errores[] = "El campo dni es requerido";
        }
        if (isset($_GET['cuit'])) {
            $cuit = $_GET['cuit'];
        } else {
            $errores[] = "El campo cuit es requerido";
        }
        if (isset($_GET['estado_civil'])) {
            $estado_civil = $_GET['estado_civil'];
            if ($estado_civil == 'casado') {
                $estado_civil = 1;
            } else {
                $estado_civil = 0;
            }
        } else {
            $errores[] = "El campo estado_civil es requerido";
        }
        if (isset($_GET['hijos'])) {
            $hijos = $_GET['hijos'];
        } else {
            $errores[] = "El campo hijos es requerido";
        }
        if (isset($_GET['genero'])) {
            $genero = $_GET['genero'];
            if ($genero == 'male') {
                $genero = 1;
            } else {
                $genero = 0;
            }
        } else {
            $errores[] = "El campo Nombre es requerido";
        }
        if (isset($_GET['pais'])) {
            $pais = $_GET['pais'];
        } else {
            $errores[] = "El campo pais es requerido";
        }
        if (isset($_GET['provincia'])) {
            $provincia = $_GET['provincia'];
        } else {
            $errores[] = "El campo provincia es requerido";
        }
        if (isset($_GET['localidad'])) {
            $localidad = $_GET['localidad'];
        } else {
            $errores[] = "El campo localidad es requerido";
        }
        if (isset($_GET['calle'])) {
            $calle = $_GET['calle'];
        } else {
            $errores[] = "El campo calle es requerido";
        }
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
        } else {
            $errores[] = "El campo numero es requerido";
        }
        if (isset($_GET['piso'])) {
            $piso = $_GET['piso'];
        } else {
            $errores[] = "El campo piso es requerido";
        }

        if (isset($_GET['codigo_postal'])) {
            $codigo_postal = $_GET['codigo_postal'];
        } else {
            $errores[] = "El campo codigo_postal es requerido";
        }

        if (isset($_GET['email'])) {
            $email = $_GET['email'];
        } else {
            $errores[] = "El campo email es requerido";
        }
        if (isset($_GET['telefono_celular'])) {
            $telefono_celular = $_GET['telefono_celular'];
        } else {
            $errores[] = "El campo telefono_celular es requerido";
        }

        if (isset($_GET['telefono_fijo'])) {
            $telefono_fijo = $_GET['telefono_fijo'];
        } else {
            $errores[] = "El campo telefono_fijo es requerido";
        }



        if (!empty($errores)) {
            foreach ($errores as $error) {
                \Drupal::messenger()->addMessage(($error), 'error');
            }
            return new RedirectResponse(\Drupal::url('basic_test.add_new'));
        }

        $query = "INSERT INTO inserts (`nombre`, `apellido`, `nacimiento`,
        `dni`, `cuit`, `estado_civil`, `hijos`, `genero`, 
        `pais`, `provincia`, `localidad`, `calle`, `numero`, `piso`,
        `codigo_postal`, `email`, `telefono_celular`, `telefono_fijo`) 
           VALUES ('$nombre', '$apellido', '$nacimiento', '$dni', '$cuit',
            '$estado_civil', '$hijos', '$genero', '$pais', '$provincia', '$localidad', '$calle', '$numero',
            '$piso', '$codigo_postal', '$email', '$telefono_celular', '$telefono_fijo');";
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
         /*print('<pre>');
        print_r($amount);
        print('</pre>');
        die();*/

        $cant_paginas = intval((int)$amount / 10) + 1;
        /*print('<pre>');
        print_r($cant_paginas);
        print('</pre>');
        die();*/


        $pages = [];
        for ($i = 1; $i < $cant_paginas + 1; $i++) {
            $pages[] = $i;
        }
        /*print('<pre>');
        print_r($pages);
        print('</pre>');
        die();*/

        $pagina_requerida = $_GET["page"];
        $offset = ((int)$pagina_requerida ) * 10;
        print('<pre>');
        print_r($pagina_requerida);
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
/*
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
        $offset = ((int)$pagina_requerida -1)*10;

        $query = "SELECT * FROM drupal8.inserts limit 10 offset $offset;";
        $listado = $database->query($query)->fetchAll();
        $vars = [];
        $vars['listado'] = $listado;
        $vars['pages'] = $pages;

        return [
            '#theme' => 'list_page',
            '#vars' => $vars





        ];*/

       /* $pagina_requerida = $_GET["page"];
        $offset = ((int)$pagina_requerida ) * 10;
        print('<pre>');
        print_r($pagina_requerida);
        print('</pre>');
        die();
=======
        if (isset($_GET["page"])) {
            $pagina_requerida = $_GET["page"];
        } else {
            $pagina_requerida = 1;
        }

        $offset = ((int)$pagina_requerida - 1) * 10;*/