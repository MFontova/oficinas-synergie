<?php
/*
get_header();


if(have_posts()) : while(have_posts()) : the_post();
    ?>
    <a href="<?php the_permalink() ?>"><h4><?php the_title() ?></h4></a>
    <?php

endwhile; endif;


$terms = get_terms(
    array(
        'taxonomy'      => 'provincia',
        'hide_empty'    => false,
    )
);

foreach ($terms as $term) {
    echo '<details class="cpto-details"><summary class="cpto-summary"><h4>'.$term->name.'</h4></summary>'.do_shortcode('[oficinas provincia="'.$term->name.'"]').'</details>';
}



get_footer();

?>