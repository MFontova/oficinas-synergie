<?php
/**
 * Single post oficina content template.
 *
 *
 */

// Recogemos todos los datos que se piden al crear una oficina (campos personalizados)
$direccion =    get_post_meta( get_the_ID(), 'direccion', true );
$cp =           get_post_meta( get_the_ID(), 'cp', true );
$ciudad =       get_post_meta( get_the_ID(), 'ciudad', true );
$horario =      get_post_meta( get_the_ID(), 'horario', true );
$telefono =     get_post_meta( get_the_ID(), 'telefono', true );
$fax =          get_post_meta( get_the_ID(), 'fax', true );
$email =        get_post_meta( get_the_ID(), 'email', true );
$linkbookings = get_post_meta( get_the_ID(), 'linkbookings', true );
$linkofertas =  get_post_meta( get_the_ID(), 'linkofertas', true );


get_header();

?>

// Creamos el contenido añadiendo los datos que hemos recogido antes
<div class="cpto-cont-hero">
    <h1 class="cpto-title1">SYNERGIE MÁS CERCA DE TI<br><span class="cpto-red"> <?php the_title() ?> </span></h1>
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'img/map-phone.png'; ?>" alt="" class="cpto-img">
</div>

<div class="cpto-cont-central">
    
    <div class="cpto-central-adress">
        <h2 class="cpto-title2"> <?php echo $ciudad ?> </h2>
        <p class="cpto-p"> <?php echo $direccion ?> <br> <?php echo $cp ?> - <?php echo $ciudad ?></p>
        <p class="cpto-p"> <?php echo $horario ?> </p>
        <p><a href="tel:<?php echo $telefono ?>" class="cpto-p"> <?php echo $telefono ?> </a></p>
        <p class="cpto-p">Contacto: <a href="mailto:<?php echo $email ?>"> <?php echo $email ?> </a></p>
    </div>
    
    <div class="cpto-central-booking">
        <h2 class="cpto-title2">Solicitar cita previa</h2>
        <p class="cpto-p">Debido a la crisis sanitaria actual causada por el Covid-19, es necesario solicitar cita previa antes de presentarse físicamente en nuestras delegaciones.</p>
        <p class="cpto-p">No está permitido entregar curriculums en papel. Si quieres dejar tu CV puedes hacerlo online <a href="https://synergie.epreselec.com/General/Alta.aspx" target="_blank"><strong>aquí</strong></a>.</p>
        <p><a href=" <?php echo $linkbookings ?> " class="cpto-button" target="_blank">Reserva hora</a></p>
    </div>

</div>

<div class="cpto-offers">
    <h2 class="cpto-title2">¿Buscas empelo en <?php echo $ciudad ?>?</h2>
    <a href=" <?php echo $linkofertas ?> " class="cpto-button" target="_blank">Ofertas de trabajo en <?php echo $ciudad ?> </a>
</div>

<?php

get_breadcrumb();

get_footer();
