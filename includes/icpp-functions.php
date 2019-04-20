<?php 
/*
 * Add my new menu to the Admin Control Panel
 */

// Hook the 'admin_menu' action hook, run the function named 'icpp_Admin_Area()'

add_action( 'admin_menu', 'icpp_Admin_Area' );
 
// Add a new top level menu link to the ACP
function icpp_Admin_Area()
{
    add_menu_page(
        'ICPP Page', // Title of the page
        'ICPP Plugin', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        plugin_dir_path(__FILE__) . '/icpp-acp-page.php' // The 'slug' - file to display when clicking the link
        );
}

function table_exist($refer,$desc){
  global $wpdb;
   $resultados = $wpdb->get_results(  
      "SELECT Referencia AS Referencia, Descripcion AS Descripcion
      FROM  `wp_component` 
      WHERE Referencia =  '$refer' and Descripcion = '$desc'
      LIMIT 0 , 30"
    );
    return $resultados;
 }

function create_table_component() {
 
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "component";
        $created = dbDelta(  
          "CREATE TABLE IF NOT EXISTS $nombreTabla (
            Referencia varchar(60) NOT NULL DEFAULT '',
            Descripcion varchar(64) NOT NULL DEFAULT ''
          ) CHARACTER SET utf8 COLLATE utf8_general_ci;"
        );
}

function insert_component($refer,$desc) {
    global $wpdb;
    $insert = dbDelta(  
      "INSERT INTO  wp_component (
          Referencia, Descripcion) 
        VALUES ('$refer','$desc')"
    );
    
}

function create_page($title,$content) {
        $post_data = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => '1',
            'post_category' => array(1,2),
            'page_template' => 'Componente',
        );
        $error_obj = Null;
        wp_insert_post( $post_data, $error_obj );
    
}


