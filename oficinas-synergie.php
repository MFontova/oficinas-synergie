<?php
/*
Plugin Name: Oficinas de Synergie
Description: Con este plugin podemos generar oficinas de una forma muy simple, solo rellenando unos campos. Deveuelve una estructura de enlaces lógica y ordenada. Crea un Custom Post Type llamado "oficinas", así como una taxonomía llamada "provincias". Incluye plantillas PHP para la pagina de cada oficina y para el archivo de oficinas. Crea también shortcodes que podemos introducir donde queramos para mostrar un listado de oficinas según la provincia.
Version: 0.01
Author: Marc Fontova
License: GPL 2+
*/

// Registramos la taxonomía personalizada "provincias"
if ( ! function_exists( 'ctax_provincia' ) ) {

    // Register Custom Taxonomy
    function ctax_provincia() {
    
        $labels = array(
            'name'                       => _x( 'Provincias', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Provincia', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Provincias', 'text_domain' ),
            'all_items'                  => __( 'Todas las provincias', 'text_domain' ),
            'parent_item'                => __( 'Provincia padre', 'text_domain' ),
            'parent_item_colon'          => __( 'Provincia padre:', 'text_domain' ),
            'new_item_name'              => __( 'Nueva provincia', 'text_domain' ),
            'add_new_item'               => __( 'Añadir nueva provincia', 'text_domain' ),
            'edit_item'                  => __( 'Editar provincia', 'text_domain' ),
            'update_item'                => __( 'Actualizar provincia', 'text_domain' ),
            'view_item'                  => __( 'Ver provincia', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separa las provincias por comas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Añadir o borrar provincias', 'text_domain' ),
            'choose_from_most_used'      => __( 'Escoger de las más usadas', 'text_domain' ),
            'popular_items'              => __( 'Provincias populares', 'text_domain' ),
            'search_items'               => __( 'Buscar provincias', 'text_domain' ),
            'not_found'                  => __( 'No se ha encontrado', 'text_domain' ),
            'no_terms'                   => __( 'No hay provincias', 'text_domain' ),
            'items_list'                 => __( 'Lista de provincias', 'text_domain' ),
            'items_list_navigation'      => __( 'Lista de navegación de provincias', 'text_domain' ),
        );
        $rewrite = array(
            'slug'                       => 'oficinas',
            'with_front'                 => false,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
        );
        register_taxonomy( 'provincia', array( 'oficinas' ), $args );
    
    }
    add_action( 'init', 'ctax_provincia', 0 );
}

// Registramos la taxonomía personalizada "codigo"
if ( ! function_exists( 'ctax_codigo' ) ) {

    // Register Custom Taxonomy
    function ctax_codigo() {
    
        $labels = array(
            'name'                       => _x( 'Código', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Código', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Códigos', 'text_domain' ),
            'all_items'                  => __( 'Todos los códigos', 'text_domain' ),
            'parent_item'                => __( 'Código padre', 'text_domain' ),
            'parent_item_colon'          => __( 'Código padre:', 'text_domain' ),
            'new_item_name'              => __( 'Nuevo código', 'text_domain' ),
            'add_new_item'               => __( 'Añadir nuevo código', 'text_domain' ),
            'edit_item'                  => __( 'Editar código', 'text_domain' ),
            'update_item'                => __( 'Actualizar código', 'text_domain' ),
            'view_item'                  => __( 'Ver código', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separa los códigos por comas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Añadir o borrar códigos', 'text_domain' ),
            'choose_from_most_used'      => __( 'Escoger de los más usados', 'text_domain' ),
            'popular_items'              => __( 'Códigos populares', 'text_domain' ),
            'search_items'               => __( 'Buscar códigos', 'text_domain' ),
            'not_found'                  => __( 'No se ha encontrado', 'text_domain' ),
            'no_terms'                   => __( 'No hay códigos', 'text_domain' ),
            'items_list'                 => __( 'Lista de códigos', 'text_domain' ),
            'items_list_navigation'      => __( 'Lista de navegación de códigos', 'text_domain' ),
        );
        $rewrite = array(
            'slug'                       => 'codigos',
            'with_front'                 => false,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
        );
        register_taxonomy( 'codigo', array( 'oficinas' ), $args );
    
    }
    add_action( 'init', 'ctax_codigo', 0 );
}

// Registramos el Custom Post Type personalizado "oficinas"
if ( ! function_exists('cpt_oficinas') ) {

    // Register Custom Post Type
    function cpt_oficinas() {
    
        $labels = array(
            'name'                  => _x( 'Oficinas', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Oficina', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Oficinas', 'text_domain' ),
            'name_admin_bar'        => __( 'Oficina', 'text_domain' ),
            'archives'              => __( 'Archivo de oficinas', 'text_domain' ),
            'attributes'            => __( 'Atributos de oficina', 'text_domain' ),
            'parent_item_colon'     => __( 'Oficina padre', 'text_domain' ),
            'all_items'             => __( 'Todas las oficinas', 'text_domain' ),
            'add_new_item'          => __( 'Añadir nueva oficina', 'text_domain' ),
            'add_new'               => __( 'Añadir nueva', 'text_domain' ),
            'new_item'              => __( 'Nueva oficina', 'text_domain' ),
            'edit_item'             => __( 'Editar oficina', 'text_domain' ),
            'update_item'           => __( 'Actualizar oficina', 'text_domain' ),
            'view_item'             => __( 'Ver oficina', 'text_domain' ),
            'view_items'            => __( 'Ver oficinas', 'text_domain' ),
            'search_items'          => __( 'Buscar oficina', 'text_domain' ),
            'not_found'             => __( 'No se ha encontrado', 'text_domain' ),
            'not_found_in_trash'    => __( 'No se ha encontrado en la papelera', 'text_domain' ),
            'featured_image'        => __( 'Imagen destacada', 'text_domain' ),
            'set_featured_image'    => __( 'Establecer imagen destacada', 'text_domain' ),
            'remove_featured_image' => __( 'Borrar imagen destacada', 'text_domain' ),
            'use_featured_image'    => __( 'Utilizar como imagen destacada', 'text_domain' ),
            'insert_into_item'      => __( 'Insertar a la oficina', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Cargado a la oficina', 'text_domain' ),
            'items_list'            => __( 'Lista de oficinas', 'text_domain' ),
            'items_list_navigation' => __( 'Lista de navegación de oficinas', 'text_domain' ),
            'filter_items_list'     => __( 'Filtrar oficinas de la lista', 'text_domain' ),
        );
        $rewrite = array(
            'slug'                  => '/oficinas/%provincia%',
            'with_front'            => false,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Oficina', 'text_domain' ),
            'description'           => __( 'CPT de oficinas', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'custom-fields', 'page-attributes', 'post-formats' ),
            'taxonomies'            => array( 'provincia' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-building',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'oficinas', $args );
    
    }
    add_action( 'init', 'cpt_oficinas', 0 );
}

//Función con la que reemplazamos el slug %provincia% por la provincia en cuestión
function replace_system_type_category( $post_link, $id = 0 ){
    $post = get_post($id);  
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'provincia' );
        if( $terms ){
            return str_replace( '%provincia%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;  
}
add_filter( 'post_type_link', 'replace_system_type_category', 1, 3 );


//Creamos los campos que automáticamente aparecerán en el CPT "oficinas"
function campos_automatizados($post_id){
    if(get_post_type($post_id) == 'oficinas'){
        add_post_meta($post_id, 'direccion','', true);
        add_post_meta($post_id, 'cp','', true);
        add_post_meta($post_id, 'ciudad','', true);
        add_post_meta($post_id, 'horario','De 9h a 14h y de 15h a 18h', true);
        add_post_meta($post_id, 'telefono','', true);
        add_post_meta($post_id, 'email','', true);
        add_post_meta($post_id, 'linkbookings','', true);
        add_post_meta($post_id, 'linkofertas','', true);
    }
}
add_action('wp_insert_post','campos_automatizados');


// Añadimos las plantillas que vamos a utilizar para cada oficina en singular y para la taxonomía provincia
function oficinas_synergie_templates( $template )
{	
	if( is_singular( 'oficinas' ) ) {
        $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/single-oficinas.php';
	}

    if( is_tax('provincia') ) {
        $template = WP_PLUGIN_DIR .'/'.plugin_basename( dirname(__FILE__) ) .'/templates/taxonomy-provincia.php';
    }
	
    return $template;
}
add_filter( 'template_include', 'oficinas_synergie_templates' );


// Registramos y ponemos en cola los estilos css
function oficinas_styles(){
    global $post;
    if(is_archive() || is_singular('oficinas') || has_shortcode($post->post_content,'oficinas') || has_shortcode($post->post_content,'provincias')){
        wp_register_style('oficinas_estilos', plugins_url('oficinas-style.css', __FILE__));
        wp_enqueue_style('oficinas_estilos');
    }
}
add_action('wp_enqueue_scripts','oficinas_styles');


// Añadimos los shortcodes para mostrar los listados de oficinas dónde queramos.
function oficinas_shortcodes( $atributos ){
    extract(shortcode_atts(array('provincia' => '',), $atributos));
    //return ('Has seleccionado '.$provincia);

    // WP_QUERY
    $args = array(
        'orderby' => 'title',
        'order' => 'asc',
        'post_type' => 'oficinas',
        'posts_per_page' => -1,
        'tax_query' => array(
            array (
                'taxonomy' => 'provincia',
                'field' => 'slug',
                'terms' => $provincia,
            )
        ),
    );

    $the_query = new WP_Query($args);

    // Definimos el Loop
    if ($the_query->have_posts()){
        
        $result .= '<div class="cpto-lista-provincias">';
        
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $result .= '<a class="cpto-item-list" href="'.get_the_permalink().'">'.get_the_title();
            $result .= '</a>';
        }
        $result .= '</div>';
    }

    wp_reset_postdata();

    return $result;

}
add_shortcode('oficinas','oficinas_shortcodes');


//Añadimos el shortcode para mostrar el listado de provincias.
function provincias_shortcode(){

    $provincias = get_terms(array(
        'taxonomy' => 'provincia',
        'hide_empty' => true,
    ));
    $content .= '<h3>ENCUENTRA LA OFICINA MÁS CERCANA EN TU PROVINCIA</h3>';
    $content .= '<div class="cpto-lista-provincias">';
    foreach ($provincias as $provincia) {
        $provincia_link = get_term_link($provincia);
        $content .= '<a href="'.esc_url($provincia_link).'"><p class="cpto-item-list">'.$provincia->name.'</p></a>';
    }
    $content .= '</div>';

    return $content;
}
add_shortcode('provincias','provincias_shortcode');

// Breadcrumbs
function get_breadcrumb(){
    // Imprimimos el inicio del breadcrumb con el enlace a la home y a la página oficinas
    // Inicio >> Oficinas
    echo '<p><a href="'.home_url().'">Inicio</a> >> <a href="/oficinas/">Oficinas</a> >> ';

    // Evaluamos si se trata de una página de taxonomía
    if(is_tax('','provincia')){
        // Imprimimos el título de la taxonomía
        // Inicio >> Oficinas >> Provincia
        echo ' '.single_term_title();
    }

    // Evaluamos si se trata de single
    elseif(is_single()){
        // Recogemos todas los terms de la página y los recorremos (solo debe haber uno)
        $terms = get_the_terms( $post->ID, 'provincia' );
        if ($terms) {
            foreach($terms as $term) {
                // Imprimimos el term con el enlace
                // Inicio >> Oficinas >> Provincia >> Oficina 
                echo '<a href="'.get_term_link($term).'">'.$term->name.'</a> >> ';
                the_title();
            } 
        }
    }
    echo '</p>';
}