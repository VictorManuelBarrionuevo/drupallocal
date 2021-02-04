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
        
        $paises= "hola";

        return [
            '#theme' => 'form_ajax',
            '#vars' =>$paises
        ];
    }
    
}
