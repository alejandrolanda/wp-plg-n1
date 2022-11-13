<?php
/**
* Plugin Name: Reto 01: Plugin a prueba de fallos
* Plugin URI: #
* Description: Se solicita crear un plugin wordpress que al instalarse, habilite una pagina conocer el estado de wordpress.
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 7.2, 7.3
* Author: Jesús Landa
* Author URI: #
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: reto01Status
* Domain Path: /languages
*/

if( !function_exists( 'res_options_page_status' ) ){

  function res_options_page_status(){
    add_menu_page(
    'Reto 01 - Estado WPs',
    'Reto 01 - Estado WPs',
    'manage_options',
    'res_options_page_status',
    'res_options_page_status_display',
    'dashicons-performance',
    '15'
    );
  }
  add_action( 'admin_menu', 'res_options_page_status' );
}

if( !function_exists( 'res_options_page_status_display')){
  function res_options_page_status_display(){
    ?>
    <div class="wrap">
      <h1>System Status</h1>
      <hr>
    <?php
      /*
      */
      $wstatus_safe_mode= ini_get('safe_mode') ? TRUE : FALSE; 
      //$wstatus_safe_mode=1;
      //$wstatus_safe_mode=0;
      /* */
      if($wstatus_safe_mode){
        // TRUE::MOSTRAR ESTADO DE WP
          echo '<p>Modo seguro <span style="color:green"><b>Activado</b></span>:</p> ';
          echo "<p>* En el php.ini está configurado <b>safe_mode=On</b> </p>";
          echo "<p><b>Info:</b> Al activar el modo safe_mode lo que se hace es impedir el acceso a disco del PHP y no se pueden crear, 
          modificar, borrar o leer archivos desde él. El problema que esto presenta, es que hay muchos programas PHP 
          que necesitan escribir o leer de disco. Y no hay forma de hacer que funcione bien con el safe_mode activado.</p>";
          echo "<h2>Detalles Técnicos</h2>";
          echo "<hr>";
          /**/
          echo "<p><b>[safe_mode]</b></p>";
          echo "<ul>";
          echo '<li> safe_mode = '; echo get_cfg_var('safe_mode')? "On" : "Off"; 
          echo "</ul>";
          echo "<hr>";
          /**/
          echo "<p><b>[MySQL]</b></p>";
          echo "<ul>";
          echo '<li> mysql.allow_local_infile = ' .  get_cfg_var('mysql.allow_local_infile');
          echo '<li> mysql.allow_persistent = ' .  get_cfg_var('mysql.allow_persistent');
          echo '<li> mysql.cache_size = ' .  get_cfg_var('mysql.cache_size');
          echo '<li> mysql.max_persistent = ' .  get_cfg_var('mysql.max_persistent');
          echo '<li> mysql.max_link = ' .  get_cfg_var('mysql.max_link');
          echo '<li> mysql.default_port = ' .  get_cfg_var('mysql.default_port');
          echo '<li> mysql.default_socket = ' .  get_cfg_var('mysql.default_socket');
          echo '<li> mysql.connect_timeout = ' .  get_cfg_var('mysql.connect_timeout');
          echo '<li> mysql.trace_mode = '; echo get_cfg_var('mysql.trace_mode') ? "On" : "Off"; ;
          echo "</ul>";
          echo "<hr>";
          /**/
          echo "<p><b>[SERVIDOR]</b></p>";
          echo '<table class="widefat importers striped" style="width:75% !important;">';
          echo "<tbody>";
          foreach ($_SERVER as $parm => $value){
            echo "<tr>";
            echo "<td>"; echo "$parm = "; echo "</td>";
            echo "<td>"; echo "$value"; echo "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "<table>";
      }
      else{
          // FALSE:: "MOSTRAR EL INDEX NORMAL DE WP";
          //echo "MOSTRAR EL INDEX NORMAL DE WP";
          echo '<p>Modo seguro <span style="color:red"><b>Desactivado</b></span>:</p> ';
          echo "<p>* En el php.ini está configurado ";
          echo '<b>safe_mode=</b>'; echo get_cfg_var('safe_mode')? "On" : "Off"; 
          echo "</p>";
      }
    ?>
    </div>
    <?php
  }
}

