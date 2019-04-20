<?php
/*
Plugin Name: ICPP Plugin
Description: Este Plugin carga un archivo EXEL y crea nuevos contenidos con la informacion!
Author: Icomppluselec
*/
// Include icpp-functions.php, use require_once to stop the script if mfp-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'includes/icpp-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/Classes/PHPExcel.php';
require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );