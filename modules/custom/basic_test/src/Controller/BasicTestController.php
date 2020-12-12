<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\basic_test\Controller\BasicTestController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\basic_test\Controller;

class BasicTestController
{

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function hola_mundo()
    {
        return [
            '#theme' => 'basic_test_theme_test'
        ];
    }
}
