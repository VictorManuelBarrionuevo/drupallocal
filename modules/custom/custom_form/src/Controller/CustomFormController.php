<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\custom_form\Controller\CustomFormController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\custom_form\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Messenger\MessengerInterface;

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
        //TeWst

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
        $genero = $_POST['genero'];
        if ($genero == 'male') {
            $genero = 1;
        } else {
            $genero = 0;
        }

        $pais = $_POST['pais'];
        $provincia = $_POST['provincia'];
        $localidad = $_POST['localidad'];
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $piso = $_POST['piso'];
        $codigo_postal = $_POST['codigo_postal'];
        $email = $_POST['email'];
        $telefono_celular = $_POST['telefono_celular'];
        $telefono_fijo = $_POST['telefono_fijo'];
        /*print ( '<pre>' )  ;
        print_r ( $_POST['nacimiento'] ) ;
        print ( '</pre>' ) ;
        die;*/


        $query_to_insert = "INSERT INTO `forms` (`nombre`, `apellido`, `nacimiento`,
         `dni`, `cuit`, `estado_civil`, `hijos`, `genero`, 
         `id_pais`, `id_provincia`, `localidad`, `calle`, `numero`, `piso`,
         `codigo_postal`, `email`, `telefono_celular`, `telefono_fijo`) 
            VALUES ('$nombre', '$apellido', '$nacimiento', '$dni', '$cuit',
             '$est_civil', '$hijos', '$genero', '$pais', '$provincia', '$localidad', '$calle', '$numero',
             '$piso', '$codigo_postal', '$email', '$telefono_celular', '$telefono_fijo');";
        $database->query($query_to_insert);
        

    
        \Drupal::messenger()->addMessage(('Usuario'.' '.  ($nombre = $_POST['nombre']) .' ' .  ($apellido = $_POST['apellido']).' ' .'Guardado Exitosamente'), 'warning');
        return new RedirectResponse(\Drupal::url('custom_form.list'));
    }





    public function list()

    {
        $database = \Drupal::database();
        $query_get_list = " SELECT f.id, f.nombre, f.apellido, f.nacimiento, f.dni, f.cuit,
        f. estado_civil, f.hijos, f.genero, p.name as pais, pr.name as provincia, f.localidad, f.calle, f.numero, f.piso, 
        f.codigo_postal, f.email, f.telefono_celular, f.telefono_fijo
                           FROM forms f
                           inner join paises p on f.id_pais = p.id
                           inner join provincias pr on f.id_provincia = pr.id;";

        $form_list = $database->query($query_get_list)->fetchAll();



        /*print ( '<pre>' )  ;
        print_r ( $form_list ) ;
        print ( '</pre>' ) ;
        die;*/

        return [
            '#theme' => 'custom_form_list',
            '#variables' => $form_list,
        ];
    }

    public function delete_info(Request $request)

    {
        $form_id = $request->query->get('id');
        $form_nombre = $request->query->get('nombre');
        $form_apellido = $request->query->get('apellido');


        $database = \Drupal::database();

        $sqlborrar = "DELETE FROM forms WHERE id=$form_id;";
        $database->query($sqlborrar);

        




        \Drupal::messenger()->addMessage(('Usuario'.' '.  ($form_nombre).' '.  ($form_apellido).' ' .'Borrado Exitosamente'), 'error');
        return new RedirectResponse(\Drupal::url('custom_form.list'));
    }




    public function edit_info(Request $request)

    {
        $form_id = $request->query->get('id');
        

        $database = \Drupal::database();

        $query_pais_prov = "SELECT pa.id as pais_id, pa.name as pais_name, pr.id as provincia_id, pr.name as provincia_name 
        FROM provincias pr
        inner join paises pa 
        on pa.id = pr.id_pais;";
        $pais_prov = $database->query($query_pais_prov)->fetchAll();
        


        $query_get_list = " SELECT f.id, f.nombre, f.apellido, f.nacimiento, f.dni, f.cuit,
        f. estado_civil, f.hijos, f.genero, p.name as pais, pr.name as provincia, f.localidad, f.calle, f.numero, f.piso, 
        f.codigo_postal, f.email, f.telefono_celular, f.telefono_fijo
                           FROM forms f
                           inner join paises p on f.id_pais = p.id
                           inner join provincias pr on f.id_provincia = pr.id
                           where f.id=$form_id;";

        $form_edit = $database->query($query_get_list)->fetchAll();

        $query_get_pais_prov = " SELECT p.name as pais, pr.name as provincia
                           FROM forms f
                           inner join paises p on f.id_pais = p.id
                           inner join provincias pr on f.id_provincia = pr.id
                           where f.id=$form_id;";

        $form_pais_prov = $database->query($query_get_pais_prov)->fetchAll();
                           

        
        $array_vars= [];
        $array_vars['pais_prov'] = $pais_prov;
        $array_vars['form_edit'] = $form_edit;
        $array_vars['form_pais_prov'] = $form_pais_prov;


       /* print ( '<pre>' )  ;
        print_r ( $form_pais_prov  ) ;
        print ( '</pre>' ) ;
        die;


        /*Array

    [0] => stdClass Object
        (
            [pais] => Brazil
            [provincia] => Sao Pablo
        )*/

//quiero traer y seleccionar el valor pais y provincia, para poder igualarlo y poder enviarlo a jquery para poder ponerle un selected ahi


        return [
            '#theme' => 'custom_form_edit',
            '#array_vars' => $array_vars
        ];
    }

    public function save_edit(Request $request)

    {
        $form_id = $request->query->get('id');
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
        $genero = $_POST['genero'];
        if ($genero == 'male') {
            $genero = 1;
        } else {
            $genero = 0;
        }

        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $piso = $_POST['piso'];
        $codigo_postal = $_POST['codigo_postal'];
        $email = $_POST['email'];
        $telefono_celular = $_POST['telefono_celular'];
        $telefono_fijo = $_POST['telefono_fijo'];

        $query_to_update = "UPDATE forms SET nombre='$nombre', apellido='$apellido', nacimiento='$nacimiento', dni='$dni', cuit='$cuit', 
                            estado_civil='$est_civil', hijos='$hijos', genero='$genero',
                            calle=' $calle', numero='$numero', piso='$piso', codigo_postal='$codigo_postal', email='$email',
                            telefono_celular='$telefono_celular', telefono_fijo='$telefono_fijo' WHERE id=$form_id;";
        $database->query($query_to_update);


        \Drupal::messenger()->addMessage(('Usuario'.' '.  ($nombre = $_POST['nombre']) .' ' .  ($apellido = $_POST['apellido']).' ' .'Editado Exitosamente'), 'warning');
        return new RedirectResponse(\Drupal::url('custom_form.list'));
    }


    public function view_info(Request $request)

    {
        $form_id = $request->query->get('id');
        $database = \Drupal::database();
        $query_get_list = " SELECT f.id, f.nombre, f.apellido, f.nacimiento, f.dni, f.cuit,
        f. estado_civil, f.hijos, f.genero, p.name as pais, pr.name as provincia, f.localidad, f.calle, f.numero, f.piso, 
        f.codigo_postal, f.email, f.telefono_celular, f.telefono_fijo
                           FROM forms f
                           inner join paises p on f.id_pais = p.id
                           inner join provincias pr on f.id_provincia = pr.id
                           where f.id=$form_id;";



        $form_view = $database->query($query_get_list)->fetchAll();

        /*print ( '<pre>' )  ;
        print_r ( $form_view ) ;
        print ( '</pre>' ) ;
        die;

        \Drupal::messenger()->addWarning(t('This is a warning message.'));*/

        return [
            '#theme' => 'custom_form_view_list',
            '#variables' => $form_view
        ];
    }
}
