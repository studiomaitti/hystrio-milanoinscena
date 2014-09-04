<?php
/**
 * Template Name: Calendari
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<script>
    jQuery(document).ready(function(){
        jQuery('.seleziona-mese').click(function(e){
            jQuery(this).toggleClass('opened');
            jQuery('.month-list').slideToggle();
        });

    });
</script>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <div class="cerca-spettacolo-sel-rapida">
                        <h2 class="title">CALENDARI</h2>
                        <div class="seleziona-mese button">
                            <span>SELEZIONA IL MESE</span>
                            <div class="month-list">
                                <a href="/spettacolo/?l=20140901&ss=month&cal=1" class="">Settembre 2014</a>
                                <a href="/spettacolo/?l=20141001&ss=month&cal=1" class="">Ottobre 2014</a>
                                <a href="/spettacolo/?l=20141101&ss=month&cal=1" class="">Novembre 2014</a>
                                <a href="/spettacolo/?l=20141201&ss=month&cal=1" class="">Dicembre 2014</a>
                                <a href="/spettacolo/?l=20150101&ss=month&cal=1" class="">Gennaio 2015</a>
                                <a href="/spettacolo/?l=20150201&ss=month&cal=1" class="">Febbraio 2015</a>
                                <a href="/spettacolo/?l=20150301&ss=month&cal=1" class="">Marzo 2015</a>
                                <a href="/spettacolo/?l=20150401&ss=month&cal=1" class="">Aprile 2015</a>
                                <a href="/spettacolo/?l=20150501&ss=month&cal=1" class="">Maggio 2015</a>
                                <a href="/spettacolo/?l=20150601&ss=month&cal=1" class="">Giugno 2015</a>
                                <a href="/spettacolo/?l=20150701&ss=month&cal=1" class="">Luglio 2015</a>
                                <a href="/spettacolo/?l=20150801&ss=month&cal=1" class="">Agosto 2015</a>
                            </div>
                        </div>
                        <a href="/spettacolo?ss=today&cal=1" class="button oggi-domani">OGGI E DOMANI</a>
                        <a href="/spettacolo?ss=weekend&cal=1" class="button weekend">WEEKEND</a>
                    </div>

                </div><!-- .entry-content -->
            </article><!-- #post -->
        <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>