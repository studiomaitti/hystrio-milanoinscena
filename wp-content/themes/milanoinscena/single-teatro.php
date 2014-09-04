<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<script>
jQuery(document).ready(function(){
    /*
    sLeggiTutto='<div class="leggi-tutto"><a href="#"><span>+</span> LEGGI TUTTO</a>';
    jQuery('body.single-teatro .entry-content .content p:first-child').after(sLeggiTutto);
    jQuery('body.single-teatro .leggi-tutto a').click(function(e){
        e.preventDefault();
        jQuery(this).toggleClass('opened');
        if(jQuery(this).hasClass('opened')){
            jQuery(this).html('<span>-</span> RIDUCI');
        } else {
            jQuery(this).html('<span>+</span> LEGGI TUTTO');
        }
        jQuery('body.single-teatro .entry-content .content p').not('.content p:first-child').slideToggle();
    });
    */
});
</script>
<div id="primary" class="site-content">
    <div id="content" role="main">

<?php 
while (have_posts()) : the_post();
    $id_teatro=$post->ID;
    //https://www.google.com/maps/place/+urlencode
    $indirizzo=get_field('indirizzo');
    $telefono=get_field('telefono');
    $sito_internet=get_field('sito_internet');
    $sito_internet_vis=get_field('sito_internet_vis');
    if(!$sito_internet_vis)$sito_internet_vis=$sito_internet;
    $acquisto_online=get_field('acquisto_online');
    $teatro_orari=get_field('teatro_orari');
    $teatro_prezzi=get_field('teatro_prezzi');
    $zone=get_the_term_list( $id_teatro, 'zona', '<span>ZONA</span> ', ', ', '');
        
?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <div class="colonna-sx">
                        <header class="entry-header">
                            <h1 class="entry-title"><span>TEATRO:</span> <?php the_title(); ?></h1>
                        </header><!-- .entry-header -->
                        <div class="content"><?php the_content(); ?></div>
                        <div class="zona"><?php echo $zone; ?></div>
                    </div>
                    <div class="colonna-dx">
                        <div class="logo">
                            <?php the_post_thumbnail('220x999'); ?>
                        </div>
                        <?php if($indirizzo): ?><div class="indirizzo"><?php echo $indirizzo; ?></div><?php endif; ?>
                        <?php if($telefono): ?><div class="telefono"><span>Tel: </span><?php echo $telefono; ?></div><?php endif; ?>
                        <?php if($teatro_orari): ?><div class="teatro_orari"><span>Orari: </span><?php echo $teatro_orari; ?></div><?php endif; ?>
                        <?php if($teatro_prezzi): ?><div class="teatro_prezzi"><span>Prezzi: </span><?php echo $teatro_prezzi; ?> &euro;</div><?php endif; ?>
                        <?php if($sito_internet_vis): ?><div class="sito_internet"><a href="<?php echo $sito_internet; ?>" target="_blank"><?php echo $sito_internet_vis; ?></a></div><?php endif; ?>
                        <?php if($acquisto_online): ?><div class="acquisto_online"><a href="<?php echo $acquisto_online; ?>">acquista online il biglietto</a></div><?php endif; ?>
                    </div>                    
                </div><!-- .entry-summary -->

                <footer class="entry-meta stagione">
                    <h3 class="titolo-stagione">Stagione 2014/15</h3>
                    <div class="spettacoli-loop">
<?php
$args=array(
    'post_type' => array( 'spettacolo' ),
    'posts_per_page'=>-1,
    'meta_query' => array(
            array(
                    'key' => 'teatro',
                    'value' => $id_teatro
            )
    ), 
    'orderby' => 'meta_value', 
    'meta_key' => 'data_da',
    'order'=>'ASC'
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
            $the_query->the_post();
            get_template_part( 'spettacolo','lista-stagione' );
    }
}
wp_reset_postdata();
?>

                        
                    </div>
                </footer><!-- .entry-meta -->
            </article><!-- #post -->



        <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>