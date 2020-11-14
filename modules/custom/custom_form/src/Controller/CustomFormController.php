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
        return [
            '#theme' => 'custom_form'

        ];
    }
    public function save_new()
    {
        print_r("<pre>");
        print_r($_POST['apellido']);
        print_r("</pre>");
    }
}
