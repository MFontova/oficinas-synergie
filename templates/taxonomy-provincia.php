<?php

get_header();

$provincia = get_queried_object();
$title = $provincia->name;
$slug = $provincia->slug;

?>

<div class="cpto-cont-hero">
    <h1 class="cpto-title1">SYNERGIE MÁS CERCA DE TI<br>PROVINCIA DE <span class="cpto-red"> <?php echo $title ?> </span></h1>
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'img/map-phone.png'; ?>" alt="" class="cpto-img">
</div>

<div>
    <h2>Oficinas en la provincia de <?php echo $title ?></h2>
</div>

<?php

//Query con las oficinas de la provincia en cuestión
$args = array(
    'orderby' => 'title',
    'order' => 'asc',
    'post_type' => 'oficinas',
    'posts_per_page' => -1,
    'tax_query' => array(
        array (
            'taxonomy' => 'provincia',
            'field' => 'slug',
            'terms' => $slug,
        )
    ),
);

$the_query = new WP_Query($args);


if ($the_query->have_posts()){
    
    ?>
    <div class="cpto-lista-provincias">
    <?php
    while ($the_query->have_posts()) {
        $the_query->the_post();
        
        ?>
        
        <a class="cpto-item-list" href="<?php the_permalink() ?>"><?php the_title() ?></a>


        <?php
    }
    ?>
    </div>
    <?php
}

wp_reset_postdata();

get_footer();

?>