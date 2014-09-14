<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<script>
    jQuery(document).ready(function(){
        //MENU
        if(jQuery('.leggi-tutto').length){
            jQuery('.leggi-tutto').bind('click',function(e){
                e.preventDefault();
                jQuery(this).hide();
                jQuery('.leggi-tutto-testo').show();
            });
        }
    });
</script>


<div class="claim">
    Il primo sito di recensioni di spettacoli teatrali in cartellone a Milano scritte da critici professionisti
    <a href="#" class="leggi-tutto">... [leggi tutto]</a>
    <span class="leggi-tutto-testo">che collaborano abitualmente alla rivista <a href="http://www.hystrio.it" target="_blank" title="Visita il sito Hystrio">Hystrio</a>,
        il trimestrale di teatro e spettacolo più prestigioso e longevo d’Italia. 
        Non troverete quindi presentazioni, cronache, interviste o comunicati stampa, 
        ma solo articoli di informazione critica, realizzati dopo la visione degli spettacoli.
    </span>
</div>
        <div id="home-menu">
            <div class="menu-i menu-1">
                <a href="/cerca-spettacolo" title="Cerca lo spettacolo">
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/menu-home-cerca-spettacoli.png" alt="" />
                </a>
            </div>
            <div class="menu-i menu-2">
                <a href="/cerca-teatro/" title="Cerca un teatro">
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/menu-home-cerca-teatri.png" alt="" />
                </a>
            </div>
            <div class="menu-i menu-3">
                <a href="/spettacolo/?ss=recensioni" title="Leggi gli spettacoli recensiti">
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/menu-home-recensioni.png" alt="" />
                </a>
            </div>
            <div class="menu-i menu-4">
                <a href="/calendari" title="Oggi e Domani, il prossimo Weekend, per Mese">
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/menu-home-calendari.png" alt="" />
                </a>
            </div>
        </div>
	<div id="news-list">
            <h2 class="title">News</h2>
            <?php if ( have_posts() ) : ?>
                    <?php 
                    $i=0;
                    while ( have_posts() ) : the_post(); 
                        $link=get_field('link');
                        
                        if(!$link)$link=  get_permalink();
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-num-'.($i%4) ); ?>>
                            <header class="header">
                                <div class="data"><span><?php echo get_the_date(); ?></span></div>
                                <h2>
                                    <a href="<?php echo $link; ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>
                                <div class="leggi-news"><a href="<?php echo $link; ?>" rel="bookmark">LEGGI NEWS</a></div>
                            </header><!-- .entry-header -->
                            <div class="hentry-bottom"></div>

                        </article><!-- #post -->
                    <?php $i++; ?>
                    <?php endwhile; ?>
            <?php endif; // end have_posts() check ?>
	</div><!-- #primary -->
<?php get_footer(); ?>