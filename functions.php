<?php

function iniciar_tema(){
  // esto permite imagen destacadas en las páginas
  add_theme_support( "post-thumbnails" );
  
  // esto nos permite tener el título del sitio
  add_theme_support( "title-tag" );

  // Añade un menu al tema
  register_nav_menus(
    array(
        "top_menu" => "Menú Principal"
    )
  );
}

// se usa un hook para integrar esta función
add_action('after_setup_theme', 'iniciar_tema');

// para inyectar JS o CSS usamos lo siguiente
function anadirJSyCss(){
    wp_register_style( "bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", "", "5.3.3", "all" );
    wp_register_style( "fuente", "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap", "", "1.0", "all");
    wp_enqueue_style( "estilos", get_stylesheet_uri(), array("bootstrap", "fuente"), "1.0", "all");
    
    wp_register_script( "bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js", '', '5.3.3', true);
    
    // Se tiene que hacer en dos partes 

    // 1. se registra
    wp_register_script(
        'script', 
        get_template_directory_uri() . "/script.js", 
        '', '1.0', 
        true
    );

    // 2. Se pone
    wp_enqueue_script('script');
}

add_action('wp_enqueue_scripts', 'anadirJSyCss');


function activarSidebar() {
    register_sidebar(
        array(
            "name" => "Pie de página",
            "id" => "footer",
            "description" => "Zona de widgets para pie de página", // Cambiado a "description"
            "before_title" => "<p>",
            "after_title" => "</p>",
            "before_widget" => '<div id="%1$s" class="%2$s">',
            "after_widget" => "</div>",
        )
    );
}

add_action('widgets_init', 'activarSidebar');
