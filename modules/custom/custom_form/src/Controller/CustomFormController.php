<?php

/**
 * @file
 * @author Jere Muriette
 * Contains \Drupal\custom_form\Controller\CustomFormController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */

namespace Drupal\custom_form\Controller;

class CustomFormController{
    
    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
   public function add_new(){
      
    
    foreach ($_POST as $key => $value)
      {
            echo '<p>'.$key.'</p>';
            echo '<p>'.$value.'</p>';
            echo '<hr />';
       
       }
        // print_r( $_POST); 
        // die();
        


        return [
            '#theme' => 'custom_form'
        
        ];

    }
      
   /* public function add_new2(){
      
        print_r( $_POST); 



        $afip=$_POST['nombre'];
        print_r($afip);
   
    }*/
   






}