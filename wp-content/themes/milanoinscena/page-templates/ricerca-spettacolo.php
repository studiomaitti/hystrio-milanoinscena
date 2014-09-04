<?php
/**
 * Template Name: Ricerca Spettacolo
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
        jQuery('.row-f label').click(function(e){
            jQuery(this).fadeOut('fast');
            jQuery('#'+jQuery(this).attr('for')).focus();
        });
        jQuery('.row-f input.form-text').focus(function(){
            l=jQuery('.row-f label[for="'+jQuery(this).attr('id')+'"]');
            if(l.css('display')!='none'){
                l.fadeOut('fast');
            }
        });
        jQuery('.row-f input.form-text').blur(function(){
            if(jQuery(this).val()==''){
                l=jQuery('.row-f label[for="'+jQuery(this).attr('id')+'"]');
                l.fadeIn('fast');
            }
        });

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
                    <div class="cerca-spettacolo-form">
                        <h2 class="title">CERCA SPETTACOLO</h2>
                        <form method="get" action="/spettacolo" name="f-cerca-spettacolo" id="f-cerca-spettacolo" class="form">
                            <input type="hidden" name="ss" value="csp">
                            <div class="row-f">
                                <label for="f-titolo">Titolo</label>
                                <input type="text" name="f-titolo" id="f-titolo" class="form-text" />
                            </div>
                            <div class="row-f">
                                <label for="f-autore">Autore</label>
                                <input type="text" name="f-autore" id="f-autore" class="form-text" />
                            </div>
                            <div class="row-f">
                                <label for="f-regia">Regia</label>
                                <input type="text" name="f-regia" id="f-regia" class="form-text" />
                            </div>
                            <div class="row-f">
                                <label for="f-cast">Cast</label>
                                <input type="text" name="f-cast" id="f-cast" class="form-text" />
                            </div>                            
                            <div class="row-f row-submit">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="CERCA!" />
                            </div>                            
                        </form>
                    </div>
                    <div class="cerca-spettacolo-sel-rapida">
                        <h2 class="title">CERCA SPETTACOLO</h2>
                        <a href="/spettacolo?ss=today" class="button oggi-domani">OGGI E DOMANI</a>
                        <a href="/spettacolo?ss=weekend" class="button weekend">WEEKEND</a>
                        <div class="seleziona-mese button">
                            <span>SELEZIONA IL MESE</span>
                            <div class="month-list">
                                <a href="/spettacolo/?l=20140901&ss=month" class="">Settembre 2014</a>
                                <a href="/spettacolo/?l=20141001&ss=month" class="">Ottobre 2014</a>
                                <a href="/spettacolo/?l=20141101&ss=month" class="">Novembre 2014</a>
                                <a href="/spettacolo/?l=20141201&ss=month" class="">Dicembre 2014</a>
                                <a href="/spettacolo/?l=20150101&ss=month" class="">Gennaio 2015</a>
                                <a href="/spettacolo/?l=20150201&ss=month" class="">Febbraio 2015</a>
                                <a href="/spettacolo/?l=20150301&ss=month" class="">Marzo 2015</a>
                                <a href="/spettacolo/?l=20150401&ss=month" class="">Aprile 2015</a>
                                <a href="/spettacolo/?l=20150501&ss=month" class="">Maggio 2015</a>
                                <a href="/spettacolo/?l=20150601&ss=month" class="">Giugno 2015</a>
                                <a href="/spettacolo/?l=20150701&ss=month" class="">Luglio 2015</a>
                                <a href="/spettacolo/?l=20150801&ss=month" class="">Agosto 2015</a>
                            </div>
                        </div>
                    </div>

                </div><!-- .entry-content -->
            </article><!-- #post -->
        <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>